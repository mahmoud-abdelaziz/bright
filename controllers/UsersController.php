<?php 

namespace app\controllers;

use yii\web\Controller;
use app\models\User;
use Yii;
use yii\helpers\Url;
class UsersController extends Controller
{
    public $modelClass = 'app\models\User';

	public function beforeAction($action)
	{            
	        $this->enableCsrfValidation = false;

	    return parent::beforeAction($action);
	}

    public function actionRegister()
    {
		$model = new User;
		$model = $model->Attr(\Yii::$app->request->post());
		if ($model->validate()) {
		    $model->save();
			Yii::$app->mailer->compose()
			    ->setFrom("global.web.sender@gmail.com")
			    ->setTo('mahmoudabdelaziz.4com@gmail.com')
			    ->setSubject('Activate your account')
			    ->setTextBody('Plain text content')
			    ->setHtmlBody('<a href="'.Url::base(true)."/users/activate?code=".$model->activation_code."&id=".$model->id.'" target="_blank" > Click here to activate your account </a>')
			    ->send();		    
		    $response['status'] = "success";
		    $response['message'] = "successfully registered please check your mail";
		    return json_encode($response);
		} else {
		    $errors = $model->errors;
		    $response['status'] = "falied";
		    $response['message'] = $errors;
		    return json_encode($response);
		}
    }

    public function actionActivate()
    {
    	$user = User::find()->where(['id'=>$_GET['id'],'activation_code'=>$_GET['code']])->one();
    	if(!empty($user)){
    		$user->status = 'active';
    		$user->save();
    	}
    	return $this->redirect(Url::base(true));
    }

    public function actionLogin()
    {
    	$inputs = \Yii::$app->request->post();
    	if(!empty($inputs['email']) && !empty($inputs['password'])){
    		$user = User::find()->where(['email'=>$inputs['email']])->one();
    		if(!empty($user)){
    			if (Yii::$app->getSecurity()->validatePassword($inputs['password'], $user->password)) {
				    $response['status'] = "success";
		    		$response['message'] = $user->token;
		    		return json_encode($response);
				}
    		}
    	}
		    $response['status'] = "falied";
		    $response['message'] = "invalid email or password";
		    return json_encode($response);    	
    }    
}
