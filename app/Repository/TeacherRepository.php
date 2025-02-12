<?php

namespace App\Repository;

use App\Http\Controllers\Teachers\TeacherController;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{

    /*تظهر رسالة خطأ للسطر الاعلى ، لأنه يجب استدعاء دالة مكتوبة في ملف
    TeacherRepositoryInterface
    وتم استدعائها بالاسفل */




    public function getAllTeachers(){
        return Teacher::all();
    }

      public function Getspecialization(){
          return Specialization::all();
      }

      public function GetGender(){
         return Gender::all();
      }

      public function StoreTeachers($request)
      {

        try {
            $Teachers = new Teacher();
            $Teachers->Email = $request->Email;
            $Teachers->Password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Teachers.create');
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
        /*بعد ما تم كتابة الكود السابق نذهب الى
        TeacherController ---> function store */

      }


      public function editTeachers($id)
      {
          return Teacher::findOrFail($id);
         /* findOrFail
          اذا الحقل موجود اعرضه والا اعرض صفحة خطأ 404
          لو استخدمنا
          return Teacher::find($id);
          اذا الحقل موجود اعرضه والا  سوف يعرض صفحة
          error */
      }



      public function UpdateTeachers($request)
      {
          try {
              $Teachers = Teacher::findOrFail($request->id);
              $Teachers->Email = $request->Email;
              $Teachers->Password =  Hash::make($request->Password);
              $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
              $Teachers->Specialization_id = $request->Specialization_id;
              $Teachers->Gender_id = $request->Gender_id;
              $Teachers->Joining_Date = $request->Joining_Date;
              $Teachers->Address = $request->Address;
              $Teachers->save();
              toastr()->success(trans('messages.Update'));
              return redirect()->route('Teachers.index');
          }
          catch (Exception $e) {
              return redirect()->back()->with(['error' => $e->getMessage()]);
          }
      }


      public function DeleteTeachers($request)
      {
          Teacher::findOrFail($request->id)->delete();
          toastr()->error(trans('messages.Delete'));
          return redirect()->route('Teachers.index');
      }

  }
