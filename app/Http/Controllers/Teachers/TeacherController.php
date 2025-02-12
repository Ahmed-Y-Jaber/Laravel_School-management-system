<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeachers;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Http\Request;


use App\Repository\TeacherRepositoryInterface;

class TeacherController extends Controller
{

    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }



    public function index()
    {
    //    $this->Teacher->getAllTeachers();

       $Teachers = $this->Teacher->getAllTeachers();
       //$Teachers = Teacher::all();
       return view('pages.Teachers.Teachers',compact('Teachers'));
    }


    public function create()
    {
       /* الطريقة العادية كنا نعمل كدا
       $specializations = Specialization::all();
        $genders = Gender::all();
        اما في طريقتنا الجديدة
        Design Patterns
         نعمل التالي
         */
        $specializations = $this->Teacher->Getspecialization();
        $genders = $this->Teacher->GetGender();

        return view('pages.Teachers.create',compact('specializations','genders'));

    }


    public function store(StoreTeachers $request)
    {
        /*بعد كتابة كود
        TeacherRepository ---> StoreTeachers
        نكتب التالي */
        return $this->Teacher->StoreTeachers($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //return $id;

        $Teachers = $this->Teacher->editTeachers($id);
        $specializations = $this->Teacher->Getspecialization();
        $genders = $this->Teacher->GetGender();
        return view('pages.Teachers.edit',compact('Teachers','specializations','genders'));


    }


    public function update(Request $request)
    {
        return $this->Teacher->UpdateTeachers($request);
    }


    public function destroy(Request $request)
    {
        return $this->Teacher->DeleteTeachers($request);
    }


}
