<?php
/**
 * Created by Artyom Manchenkov
 * Copyright © 2015-2018 [DeepSide Interactive]
 */

namespace app\frontend\models;

use system\components\ActiveRecord;

/**
 * Class User
 * @package app\frontend\models
 */
class User extends ActiveRecord {
    public static function Auth() {
        if ($_SESSION['user_id']) {
            return true;
        }
    }

}