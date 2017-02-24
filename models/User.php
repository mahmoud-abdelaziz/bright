<?php 
namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{users}}';
    }

	public function rules()
	{
	    return [
	        ['name', 'required'],
	        ['password', 'required'],
	        ['email', 'required'],
	        ['email', 'email'],
	        ['email', 'unique', 'targetAttribute' => ['email'], 'message' => 'Email already registered .'],
	    ];
	}
	public  function Attr($array){
		$this->name = !empty($array['name']) ? ($array['name']) : '';
		$this->password = !empty($array['password']) ? ($array['password']) : '';
		$this->email = !empty($array['email']) ? ($array['email']) : '';
		$this->gender = !empty($array['gender']) ? ($array['gender']) : '';
		$this->hoppies = !empty($array['hoppies']) ? ($array['hoppies']) : '';
		$this->token = uniqid('', true);
		$this->activation_code = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(64/strlen($x)) )),1,64);
		$this->status = 'inactive';
		return $this;
	}
}