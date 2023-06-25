<?php

//Menu 

$menu = array(
  'Taco' => array('price' => 3.00, 'cooked' => 'meat'),
  'Quesadilla' => array('price' => 4.50, 'cooked' => 'cheese'),
  'Huarache' => array('price' => 6.00, 'cooked' => 'beans'),
  'Gordita' => array('price' => 5.00, 'cooked' => 'beans, cheese, and chorizo'),
  'Tamales' => array('price' => 3.50, 'cooked' => 'chicken, pork, beef, and cheese'),
  'Tostada' => array('price' => 4.00, 'cooked' => 'beans and cheese')
);

//Waiting customers 

$waiting = array();

//List of orders 

$orders = array();

//Function to cook 

function cookOrder($order){
  global $menu; 
  
  $item = $menu[$order];
  
  if($item){
    echo 'Cooking ' . $order . ' with ' . $item['cooked'] . '... ';
    echo 'Order finished! <br>';
    return true; 
  }else{
    echo 'Sorry! We don\'t have ' . $order . ' in our menu. <br>';
    return false; 
  }
}

//Function to add to waiting list

function addCustomerToWaitingList($customer){
  global $waiting; 
  
  array_push($waiting, $customer);
  echo $customer  . ' has been added to the waiting list. <br>';
}

//Function to remove from waiting list

function removeCustomerFromWaitingList(){
  global $waiting;
  
  $firstInLine = array_shift($waiting);
  echo $firstInLine . ' has been removed from the waiting list. <br>';
  return $firstInLine;
}

//Function to add order to list 

function addOrderToList($order, $customer){
  global $orders; 
  
  $orders[$customer] = $order;
  echo $customer . '\'s order of ' . $order . ' has been added to the list. <br>';
}

//Function to serve order 

function serveOrder($customer){
  global $orders; 
  
  $order = $orders[$customer];
  echo $customer . '\'s order of ' . $order . ' is ready! <br>';
  unset($orders[$customer]);
}

//Function to take order 

function takeOrder(){
  global $menu; 
  
  $customer = removeCustomerFromWaitingList();
  
  echo $customer . ' is ready to order! <br>';
  
  echo 'Here is the menu: <br>';
  foreach ($menu as $item => $data) {
    echo $item . ': $' . $data['price'] . '<br>';
  }
  
  //Get order 
  $order = readline('What would ' . $customer . ' like to order? ');
  
  //Add order to list 
  addOrderToList($order, $customer);
}

//Function to check for waiting customers 

function checkForWaitingCustomers(){
  global $waiting; 
  
  if(count($waiting) > 0){
    return true; 
  }else{
    return false; 
  }
}

//Function to check for orders 

function checkForOrders(){
  global $orders; 
  
  if(count($orders) > 0){
    return true; 
  }else{
    return false; 
  }
}

//Main function 

function main(){
  global $menu; 
  
  //Get customer name 
  $name = readline('Welcome to the Mexican Street Food Truck! What is your name? ');
  
  //Add customer to waiting list 
  addCustomerToWaitingList($name);
  
  while(checkForWaitingCustomers() || checkForOrders()){
    if(checkForWaitingCustomers()){
      takeOrder(); 
    }
    if(checkForOrders()){
      foreach($orders as $customer => $order){
        cookOrder($order); 
        serveOrder($customer); 
      }
    }
  }
  
  echo 'No more customers! Have a great day!';
}

//Run main function 

main(); 

?>