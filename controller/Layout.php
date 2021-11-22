<?php

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
       
        var_dump($params);
        exit;
        if ($this->request->isPost()) {
            try {
                $createParams = $this->request->post();
                $createParams['row'] = $createParams['x'];
                $createParams['col'] = $createParams['y'];

                unset($createParams['x'], $createParams['y']);
               

                
                $insertId = $layoutService->create($createParams);

                echo "layoutId: " . $insertId;
              
            } catch (IncorrectDataException $e) {
                $msg = ARTICLE_SAVE_ERROR;
                $errors = $e->getErrors();
                print_r($errors);
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
            print_r($layout);
        } catch (LayoutNotFoundException $e) {
            print_r($e->getMessage());
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

        $layoutService = $this->container->fabricate('layout-service');

        $layout = $layoutService->getOne($id, $x, $y);


        if($layout['layout_value'] )
            echo ("Coordinates: " .$layout['layout_value']);
        else 
            echo ("Not Found: " . $x . ' or ' . $y . ' Coordinates');
    }
    

}