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
	public function render($param){
		echo eval("?>".$this->getTemplate());
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
	
	public function toJson() {
		
	}
}

class ProfileController extends Controller {
	public function get($id){
		$model = new UserModel();
		$view = new ProfileView();
		$arr = $model->read($id);
		$view->render($model);
	}
}

class ProfileView extends View {
	private $template = "?><p><label>nom :</label><?php echo \$param['name'];?></p>";
	
	public function getTemplate(){
		return $this->template;
	}
}

class UserModel extends Model {
	public function read($id){
		
	}
}
?>