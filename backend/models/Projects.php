<?php

namespace backend\models;

use Intervention\Image\ImageManager;
use Yii;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%projects}}".
 *
 * @property integer $id
 * @property integer $total_amount
 * @property string $name
 * @property string $body
 * @property string $slug
 * @property string $image
 * @property integer $status
 * @property integer $created_at
 *
 * @property CategoryProject[] $categoryProjects
 * @property CategoriesProject[] $categories
 * @property Facilities[] $facilities
 * @property TechnologyProjects[] $technologyProjects
 * @property Technology[] $technologies
 */
class Projects extends ActiveRecord {

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $category;
    public $tech;

    public $oldImage;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%projects}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['total_amount', 'name', 'slug', 'created_at', 'body'], 'required'],
            [['total_amount', 'status', 'created_at'], 'integer'],
            [['body'], 'string'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['status'], 'in', 'range' => $this->getRangeStatus()],
            [['category', 'tech'], 'safe'],
            [['category', 'tech'], 'required'],
            [['image'], 'required', 'on' => 'create'],
            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ردیف',
            'total_amount' => 'مبلغ کل',
            'name' => 'نام پروژه',
            'body' => 'توضیحات',
            'slug' => 'مسیر',
            'image' => 'تصویر',
            'status' => 'وضیعت',
            'created_at' => 'تاریخ ثبت',
            'category' => 'دسته بندی ها',
            'tech' => 'تکنولوژی',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryProjects() {
        return $this->hasMany(CategoryProject::className(), ['project' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories() {
        return $this->hasMany(CategoriesProject::className(), ['id' => 'category'])->viaTable('{{%category_project}}', ['project' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacilities() {
        return $this->hasMany(Facilities::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTechnologyProjects() {
        return $this->hasMany(TechnologyProjects::className(), ['project' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTechnologies() {
        return $this->hasMany(Technology::className(), ['id' => 'technology'])->viaTable('{{%technology_projects}}', ['project' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProjectsQuery the active query used by this AR class.
     */
    public static function find() {
        return new ProjectsQuery(get_called_class());
    }

    public function getStatus() {
        return [
            self::STATUS_DELETED => 'حذف شده',
            self::STATUS_ACTIVE => 'فعال',
        ];
    }

    public function getRangeStatus() {
        return [
            self::STATUS_DELETED,
            self::STATUS_ACTIVE,
        ];
    }

    public static function findById($id) {
        if ($model = static::findOne($id)) {
            return $model;
        }
        throw new NotFoundHttpException('پیدا نشد.');
    }

    public function getCategoriesId() {
        $categories = [];
        foreach ($this->categories as $item) {
            $categories[] = $item->id;
        }

        return $categories;
    }

    public function getTechId() {
        $tech = [];
        foreach ($this->technologies as $item) {
            $tech[] = $item->id;
        }

        return $tech;
    }

    public $ii = FALSE;

    public function beforeValidate() {
        $this->image = UploadedFile::getInstance($this, 'image');

        return parent::beforeValidate();
    }

    public function beforeSave($insert) {
        if (!empty($this->image)) {
            $this->upload();
        }
        if (!$this->isNewRecord && empty($this->image)) {
            $this->image = $this->oldImage;
        }
        $slug = preg_replace('/ /', '-', $this->slug);
        $slug = preg_replace('/-{1,}/', '-', $slug);
        $this->slug = preg_replace('/(^-|-$)/', '', $slug);

        return parent::beforeSave($insert);
    }

    public function upload() {
        $path = Yii::getAlias('@frontend/web/photos/');
        $fullname = time() . Yii::$app->security->generateRandomString(15) . '.' . $this->image->extension;
        $this->image->saveAs($path . $fullname);
        $image = new ImageManager();
        $image->make($path . $fullname)->resize(320, 200)->save($path . 'temp-' . $fullname);
        $this->image = $fullname;
        if (!$this->isNewRecord && !empty($this->oldImage)) {
            unlink($path . $this->oldImage);
            unlink($path . 'temp-' . $this->oldImage);
        }
    }
}
