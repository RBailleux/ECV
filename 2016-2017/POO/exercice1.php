<?php
class Controller {
	public function get($id){
		
	}
	
	public function put($id, $data){
		
	}
	
	public function post($data){
		
	}
	
	public function delete($id){
		
	}
}

class View {
	public function render(){
		
	}
}

class Model {
	public function create($data){
		
	}
	
	public function read($id){
		
	}
	
	public function update($id, $data){
		
	}
	
	public function delete($id){
		
	}
}

class ProfileController extends Controller {
	public function get($id){
		$model = new UserModel();
		$view = new ProfileView();
		$view->render($model);
	}
}

class ProfileView extends View {
	
}

class UserModel extends Model {
	
}
?>