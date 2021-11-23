<?php declare(strict_types=1);

/**
 * @OA\Info(title="", version="1.0")
 */

namespace controller;

use core\exceptions\LayoutNotFoundException;
use core\exceptions\DataBaseException;
use core\exceptions\IncorrectDataException;
use core\exceptions\NotFoundException;
use core\exceptions\RequestException;
use core\exceptions\ValidatorException;

class Layout extends Base
{
    private $email;
    public function __construct(string $email)
    {

        $this->ensureIsValidEmail($email);

        $this->email = $email;
    }
    /**
    * @OA\Post(path="/api/create-layout", tags={"Layout"},
    * @OA\RequestBody(
    *       @OA\MediaType(
    *           mediaType="multipart/form-data",
    *           @OA\Schema(required={"x", "y"}, @OA\Property(property="x", type="integer"), @OA\Property(property="y", type="integer"))    
    *       )
    *   ),
    *   @OA\Response (response="200", description="Success"),
    *   @OA\Response (response="404", description="Not Found"),
    * )
    */
    /**
     * @throws NotFoundException
     * @throws RequestException
     * @throws ValidatorException
     * @throws \core\exceptions\DIContainerException
     */
    public function createLayout()
    {
      
        $layoutService = $this->container->fabricate('layout-service');
       
        $msg = '';
        $errors = null;
      
        if ($this->request->isPost()) {
            try {
                $createParams = $this->request->post();
                $createParams['row'] = $createParams['x'];
                $createParams['col'] = $createParams['y'];

                unset($createParams['x'], $createParams['y']);
               

                $insertId = $layoutService->create($createParams);




                exit(json_encode(['message' => 'Insert id: ' . $insertId . '', 'success' => true]));


            } catch (IncorrectDataException $e) {
                $errors = $e->getErrors();
                exit(json_encode(['message' => 'Insert id: ' .  $errors  . '', 'success' => false]));

            }
          
        }
    }

 /**
 * @OA\Get(path="/api/get-layout", tags={"Layout"},*
 * @OA\Response (response="200", description="Success"),
 * @OA\Response (response="404", description="Not Found"),
 * )
 */
    /**
     * @throws NotFoundException
     * @throws RequestException
     * @throws ValidatorException
     */
    public function getLayout()
    {
       
        $layoutService = $this->container->fabricate('layout-service');

        try {
            $layout = $layoutService->getAllPreviews();

            exit(json_encode(['message' => $layout, 'success' => true]));
        } catch (LayoutNotFoundException $e) {
            exit(json_encode(['message' => $e->getMessage(), 'success' => true]));

        }

       

    }

    /**
     * @OA\Get(path="/api/get-value-of-layout/{id}/{x}/{y}", tags={"Layout"},
     *   @OA\Parameter(
     *        parameter="layoutId",
     *        name="id",
     *        description="Enter LayoutId  ",
     *         @OA\Schema(
     *         type="integer"
     *         ),
     *        in="path",
     *        required=true,
     * ),
     *   @OA\Parameter(
     *        parameter="row",
     *        name="x",
     *        description="Enter x coordinates  ",
     *         @OA\Schema(
     *         type="integer"
     *         ),
     *        in="path",
     *        required=true,
     * ),
     *   @OA\Parameter(
     *        parameter="col",
     *        name="y",
     *        description="Enter y coordinates  ",
     *         @OA\Schema(
     *         type="integer"
     *         ),
     *        in="path",
     *        required=true,
     * ),
     *
     *   @OA\Response (response="200", description="Success"),
     *   @OA\Response (response="404", description="Not Found"),
     *   security={ {"bearerAuth":{}}}
     * )
     * @throws \core\exceptions\DIContainerException
     */
    public function getValueOfLayout($id, $x, $y)
    {
        try {
            $layoutService = $this->container->fabricate('layout-service');
            $layout = $layoutService->getOne($id, $x, $y);
 // sprintf ile degıstırceksın bunları
            exit(json_encode(['message' => 'layoutId:' . json_encode($layout['layout_matrix']) . ' x:' . $layout['row'] . ' y:' . $layout['col'], 'success' => true]));
        } catch (LayoutNotFoundException $e) {
            exit(json_encode(['message' => "Not Found: " . $x . ' or ' . $y . 'Coordinates or id:'. $id, 'success' => false]));

        }
    }


    public static function fromString(string $email): self
    {
        return new self($email);
    }

    public function __toString(): string
    {
        return $this->email;
    }

    private function ensureIsValidEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" is not a valid email address',
                    $email
                )
            );
        }
    }

}