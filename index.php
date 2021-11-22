
<?php



 
// function spiralPrint($m, $n, &$a)
// {
    
//     /* $k - starting row index
//         $m - ending row index
//         $l - starting column index
//         $n - ending column index
//         $i - iterator
//     */
    
//     $k = 0;
//     $l = 0;
//     $count = 0;
 
//     while ($k < $m && $l < $n)
//     {
//         /* Print the first row from
//            the remaining rows */
//         for ($i = $l; $i < $n; ++$i)
//         {
          
//            echo $a[$k][$i] = $count++ . " ";
//         }
//         $k++; // row index arttırma 
 
//         /* Print the last column
//         from the remaining columns */
//         for ($i = $k; $i < $m; ++$i) // row kadar gıtmesı gerekıyor
//         {
          
//             echo $a[$i][$n - 1] = $count++ . " ";
           
//         }
//         $n--;
 
//         /* Print the last row from
//            the remaining rows */
//         if ($k < $m)
//         {
//             for ($i = $n - 1; $i >= $l; --$i)
//             {
//                 echo $a[$m - 1][$i]  = $count++ . " ";
//             }
//             $m--;
//         }
 
//         /* Print the first column from
//            the remaining columns */
//         if ($l < $n)
//         {
//             for ($i = $m - 1; $i >= $k; --$i)
//             {
//                 echo $a[$i][$l]  = $count++ . " ";
//             }
//             $l++;
//         }    
//     }
//     echo "<pre>";
//     print_r($a);
//     echo "</pre>";

// }
 
// // Driver code

// $R = 10;
// $C = 8;
// $a =  [[]];



 
// // Function Call
// //spiralPrint($R, $C, $a);

// //createArrow();



// $r = newCase($a, $R, $C);




// function newCase(array $arr, int $R, int $C)
// {
    
//     $top = 0;
//     $bottom = $R - 1;
//     $left = 0;
//     $right = $C - 1;
//     $dir = 0;
//     $count = 0;

//     while ($top <= $bottom && $left <= $right) {
//         switch ($dir) {
//             case 0: // Right
//                 for ($i = $left; $i <= $right; $i++) {
//                      $arr[$top][$i] = $count++;
//                 }
//                 $top++;
//                 break;
//             case 1: // Down
//                 for ($i = $top; $i <= $bottom; $i++) {
//                      $arr[$i][$right] = $count++ ;
//                 }
//                 $right--;
//                 break;
//             case 2: // Left
//                 for ($i = $right; $i >= $left; $i--) {
//                      $arr[$bottom][$i] = $count++ ;
//                 }
//                 $bottom--;
//                 break;
//             case 3: // Top
//                 for ($i = $bottom; $i >= $top; $i--) {
//                       $arr[$i][$left] = $count++ ;
//                 }
//                 $left++;
//         }
//         $dir = ($dir + 1) % 4;
//     }

   
//     return $arr;
// }

// function createArrow()
// {

// $id = "MXB-487";
// $items = array(
//     array("Coffee", "Blend", "500"),
//     array("Coffee1", "Blend1", "500"),
// );

// $items_sql = array();
// if (count($items)) {
//     foreach ($items as $item) {
//         $items_sql[] = "('$id', '{$item[0]}', '{$item[1]}', '{$item[2]}')";
//     }

//     print_r($items_sql);
// }
    
// }

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');





include_once 'config.php';


include_once("vendor/autoload.php");




$router = new core\Route();


$router->run('/', [controller\Layout::class, 'getLayout'], 'get');

$router->run('/api/create-layout', [controller\Layout::class, 'createLayout'], 'post');
$router->run('/api/get-layout', [controller\Layout::class, 'getLayout'], 'get');
$router->run('/api/get-value-of-layout/{int}/{int}/{int}', [controller\Layout::class, 'getValueOfLayout'], 'get');
