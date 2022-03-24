<?

namespace application\models;
use application\core\Model;
//use Imagick;


class Admin extends Model
{
    public $error;

    public function loginValidate($post){  
        $config = require 'application/config/admin.php';
        if($config['login'] != $post['login'] or $config['password'] != $post['password'] ){
            $this->error = 'Логин или пароль введен не верно';
            return \false;
        }
        return \true;

    }

    public function postValidate($post , $type)
    {
        $nameLen = \iconv_strlen($post['name']);
        $descriptionLen = \iconv_strlen($post['description']);
        $textLen = \iconv_strlen($post['text']);
        if ($nameLen < 3 or $nameLen > 100) {
            $this->error = 'Название должно содержать от 3 до 100 симоволов';
            return \false;
        } else if ($descriptionLen < 3 or $descriptionLen > 100) {
            $this->error = 'Описание должно содержать от 3 до 100 симоволов';
            return \false;
        } else if ($textLen < 10 or $textLen > 5000) {
            $this->error = 'Текст должно содержать от 10 до 5000 символов';
            return \false;
        }

        if(empty($_FILES['img']['tmp_name']) and $type == 'add'){
            $this->error = 'Изображение не выбрано';
            return \false;
        }

        return \true;
    }


    public function postAdd($post)
    {
        $params = [
            'id' => NULL,
            'name' => $post['name'],
            'description' => $post['description'],
            'text' => $post['text'],
        ];
        $this->db->query('INSERT INTO posts VALUES ( :id, :name, :description, :text)', $params);
        return $this->db->lastInsertId();
    }

    public function postUploadImage($path,$id){
        
        //  $img = new Imagick($path);
        //  $img->cropThumbnailImage(1024,1024);
        //  $img->setImageCompressionQuality(80);
        //  $img->writeImage('public/materials/'.$id.'.jpg');
        move_uploaded_file($path, 'public/materials/'.$id.'.jpg');
    }

}
