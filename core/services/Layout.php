<?php


namespace core\services;

use core\exceptions\LayoutNotFoundException;
use core\exceptions\DataBaseException;
use core\exceptions\IncorrectDataException;
use core\exceptions\NotFoundException;
use core\exceptions\ValidatorException;
use core\Validator;
use model\Layout as LayoutModel;

class Layout extends Base
{
    const LAYOUT_NOT_FOUND = 'Not found layout..';

    private const SCHEMA = [
        'layout_id' => [
            'required' => true,
            'required_message' => 'LayoutId cannot be empty',
            'type' => Validator::TYPE_INT
        ],
        'layout_matrix' => [
            'type' => Validator::TYPE_STRING
        ],
        'row' => [
            'required' => true,
            'type_message' => 'Row cannot be string',

            'type' => Validator::TYPE_INT,

        ],
        'col' => [
            'required' => true,
            'type_message' => 'Col cannot be empty',
            'type' => Validator::TYPE_INT,
            
        ]
    ];

    private LayoutModel $mLayout;

    public function __construct(LayoutModel $mLayout, Validator $validator)
    {
        $this->mLayout = $mLayout;
        parent::__construct($validator);
        $this->validator->setSchema(self::SCHEMA);
    }

    /**
     * @return array
     * @throws LayoutNotFoundException
     */
    public function getAllPreviews(): array
    {
        $layouts = $this->mLayout->getAll();
        if (empty($layouts)) {
            throw new LayoutNotFoundException(self::LAYOUT_NOT_FOUND);
        }
        
        return $layouts;
    }

    /**
     * @param array $params
     * @return mixed
     * @throws IncorrectDataException
     * @throws ValidatorException
     */
    public function create(array $params)
    {
        $fields = [
            'row' => (int) $params['row'],
            'col' => (int) $params['col'],
           
        ];
        $fields['layout_matrix'] = html_entity_decode($this->integerSpiral([[]], $fields['row'], $fields['col']));
        
      
        $this->params = $fields;
        $this->validator->validateByFields($fields);

        if (!$this->validator->success()) {
            throw new IncorrectDataException(
                $this->validator->errors,
                'Invalid params given to insert method'
            );
        }

       
        return $this->mLayout->insert($this->validator->clear);
    }

    /**
     * @param $id
     * @param $x
     * @param $y
     * @return mixed
     * @throws NotFoundException
     * @throws ValidatorException
     */
    public function getOne($id, $x, $y): mixed
    {
        $idAlias = $this->mLayout->getIdAlias();
       
        $this->validator->validateByFields([
            $idAlias => $id
        ]);

  
        if (!$this->validator->success()) {
            throw new NotFoundException();
        }
      
        $layout = $this->mLayout->getById($this->validator->clear[$idAlias]);
       
        if (empty($layout)) {
            echo("Not found layoutId: " . $id);
        }

        $r = (array) json_decode($layout['layout_matrix'], true);
        
        $layout['layout_value'] = $r[$x][$y];
        
        return $layout;
    }
  
    /**
     * @param $arr
     * @param $R
     * @param $C
     * @return mixed
     */
    public function integerSpiral(array $arr = [[]], int $R, int $C): mixed
    {
        $top = 0;
        $bottom = $R - 1;
        $left = 0;
        $right = $C - 1;
        $dir = 0;
        $count = 0;
    
        while ($top <= $bottom && $left <= $right) {
            switch ($dir) {
                case 0: // Right
                    for ($i = $left; $i <= $right; $i++) {
                         $arr[$top][$i] = $count++;
                    }
                    $top++;
                    break;
                case 1: // Down
                    for ($i = $top; $i <= $bottom; $i++) {
                         $arr[$i][$right] = $count++ ;
                    }
                    $right--;
                    break;
                case 2: // Left
                    for ($i = $right; $i >= $left; $i--) {
                         $arr[$bottom][$i] = $count++ ;
                    }
                    $bottom--;
                    break;
                case 3: // Top
                    for ($i = $bottom; $i >= $top; $i--) {
                          $arr[$i][$left] = $count++ ;
                    }
                    $left++;
            }
            $dir = ($dir + 1) % 4;
        }
       
        return json_encode($arr);
    }
}