<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Expression;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $uid
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int $status
 * @property int $contact_email
 * @property int $contact_phone
 * @property string $auth_key
 * @property string $created
 * @property string $updated
 *
 * @property Auth[] $auths
 * @property Message[] $messages
 * @property Message[] $messages0
 * @property PhoneNumber[] $phoneNumbers
 * @property Trip[] $trips
 */
class User extends \yii\db\ActiveRecord
{
    const STATUS_INSERTED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'username', 'email', 'password', 'auth_key'], 'required'],
            [['status', 'contact_email', 'contact_phone'], 'integer'],
            [['email'], 'email'],
            [['created', 'updated'], 'safe'],
            [['uid', 'password', 'auth_key'], 'string', 'max' => 60],
            [['username'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 255],
            [['uid'], 'unique'],
            [['email'], 'unique'],
            [['auth_key'], 'unique'],
        ];
    }

    public function beforeValidate()
    {
        if($this->isNewRecord){
            $this->setUid();
            $this->setAuth_Key();
        }
      
        return parent::beforeValidate();
    }
    public function beforeSave($insert)
    {
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        return parent::beforeSave($insert);
    }
   
    private function setUid(){
        $this-> uid = Yii::$app->getSecurity()->generatePasswordHash(date('YmdHis'). rand(1,999999));
    }
    private function setAuth_Key(){
        $this->auth_key = Yii::$app->getSecurity()->generatePasswordHash(date('YmdHis').rand(1,999999));
    }
    public function activate(){
        $this->status = self::STATUS_ACTIVE;
        $this->setUid();
        return $this->save();
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uid' => Yii::t('app', 'Uid'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'status' => Yii::t('app', 'Status'),
            'contact_email' => Yii::t('app', 'Contact Email'),
            'contact_phone' => Yii::t('app', 'Contact Phone'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * Gets query for [[Auths]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuths()
    {
        return $this->hasMany(Auth::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['from_user_id' => 'id']);
    }

    /**
     * Gets query for [[Messages0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages0()
    {
        return $this->hasMany(Message::className(), ['to_user_id' => 'id']);
    }

    /**
     * Gets query for [[PhoneNumbers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneNumbers()
    {
        return $this->hasMany(PhoneNumber::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Trips]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrips()
    {
        return $this->hasMany(Trip::className(), ['user_id' => 'id']);
    }
}
