<?php
use yii\image\drivers\Image;

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
	'image_sizes' => [
		'thumb' => ['w' => 250, 'h' => null, 'crop' => Image::INVERSE],
		'mob_small' => ['w' => 575, 'h' => null, 'crop' => Image::INVERSE],
		'mob_big' => ['w' => 767, 'h' => null, 'crop' => Image::INVERSE],
		'large' => ['w' => 1290, 'h' => 650, 'crop' => Image::CROP],
		'small' => ['w' => 246, 'h' => 170, 'crop' => Image::CROP],
	],
	'avatar_sizes' => [
		'thumb' => 150,
		'big' => 250,
	],
	'image_exts' => 'gif, png, jpg, jpeg',
];
