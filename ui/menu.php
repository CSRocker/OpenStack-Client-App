<?php



function show_menu(){

  $menu_string = '<ul>';
  
$MENU["HOME"] = array( 'enabled'=>true, 'text'=>'Home' ,'link'=> '/oswebapp/ui/home.php' );
$MENU["INSTANCES"] = array( 'enabled'=>true, 'text'=>'Instances' ,'link'=> '/oswebapp/ui/vmInstances.php' );
$MENU["FLAVORS"] = array( 'enabled'=>true, 'text'=>'Flavors' ,'link'=> '/oswebapp/ui/flavors.php' );
$MENU['IMAGES']=array( 'enabled'=>true, 'text'=>'Images' ,'link'=> '/oswebapp/ui/images.php' );
$MENU['NETWORKS']=array( 'enabled'=>true, 'text'=>'Networks' ,'link'=> '/oswebapp/ui/networks.php' );
$MENU["LOGOUT"] = array( 'enabled'=>true, 'text'=>'Log Out' ,'link'=> '/oswebapp/logout.php' );
 foreach( $MENU as $item )
 {

    if( $item['enabled'] )
    {

       $menu_string .= '<li><a rel="nofollow" style="color: white:font-size:10"  href="'.$item['link'].'">'.$item['text'].'</a></li>';

    }

 }

$menu_string.='</ul>';
echo $menu_string;
 
}



?>