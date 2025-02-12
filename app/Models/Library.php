<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $table="library"; // في الوضع الطبيعي يتم اضافة s للجدول ولكن اذا تغير الاسم يتم تعريف الجدول داخل الموديل بهذه الطريقة

//    protected $guarded=[];

    public function grade()
    {
      //  return $this->belongsTo('App\Models\Grade', 'Grade_id');

        // طريقة اخرى لعرض العلاقة

        return $this->belongsTo(Grade::class, 'Grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'Classroom_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id');
    }

}
