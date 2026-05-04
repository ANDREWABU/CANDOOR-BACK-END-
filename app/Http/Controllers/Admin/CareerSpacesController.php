<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CareerSpace;
use App\Http\Requests\Admin\CareerSpacesRequest;
use Helpers;
use File;

class CareerSpacesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $spaces = CareerSpace::all();
        return view('AdminPanel.pages.spaces.index', compact('spaces'));
    }

    public function show($id)
    {
        $space = CareerSpace::find($id);
        return response()->json([
            'html' => view('AdminPanel.pages.spaces.edit', compact('space'))->render()
            ,200, ['Content-Type' => 'application/json']
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Space Successfully retrieved.',
            'data'  => $space
        ]);
    }

    public function store(CareerSpacesRequest $request)
    {
        $user_id = Auth()->id();
        $icon_path = Helpers::makeNewDirectory('images/Admin/career_spaces/icon');
        if(!$icon_path){
            $icon_path = 'images/Admin/career_spaces/icon';
        }
        $icon =  Helpers::saveImage($request->icon,$icon_path);

        $image_path = Helpers::makeNewDirectory('images/Admin/career_spaces/images');
        if(!$image_path){
            $image_path = 'images/Admin/career_spaces/images';
        }
        $image =  Helpers::saveImage($request->image,$image_path);
        CareerSpace::updateOrCreate([
            'title' => $request->title],[
            'user_id' => $user_id,
            'summary' => $request->summary,
            'icon' => \URL::to('images/Admin/career_spaces/icon/'.$icon),
            'image' => \URL::to('images/Admin/career_spaces/images/'.$image),
            ]);
        // session()->flash();
        return redirect()->back()->with('success','Space Successfully inserted.')->withInput();

    }
    public function update($id, Request $request)
    {
        $data=[];
        if(isset($request->icon) && !empty($request->icon)){
            $icon_path = Helpers::makeNewDirectory('images/Admin/career_spaces/icon');
            if(!$icon_path){
                $icon_path = 'images/Admin/career_spaces/icon';
            }
            $icon =  Helpers::saveImage($request->icon,$icon_path);
            $data['icon'] = 'images/Admin/career_spaces/icon/'.$icon;
            if(!empty($request->icon_old)){
                if(File::exists($request->icon_old)){
                    unlink($request->icon_old);
                }
            }

        }
        if(isset($request->image) && !empty($request->image)){
            $image_path = Helpers::makeNewDirectory('images/Admin/career_spaces/images');
            if(!$image_path){
                $image_path = 'images/Admin/career_spaces/images';
            }
            $image =  Helpers::saveImage($request->image,$image_path);
            $data['image'] = 'images/Admin/career_spaces/images/'.$image;
            if(!empty($request->image_old)){
                if(File::exists($request->image_old)){
                    unlink($request->image_old);
                }
            }
        }
        $data['title'] = $request->title;
        $data['summary'] = $request->summary;
        $update = CareerSpace::where('id',$id)->update($data);
        if($update){
            return redirect()->back()->with('success','Space Successfully updated.')->withInput();
        }else{
            return redirect()->back()->with('error','Space data is not updated.')->withInput();
        }

    }

    public function destroy($id)
    {
        CareerSpace::destroy($id);
        session()->flash('success','Space Successfully deleted.');
        return response()->json([
            'status' => 'success',
            'message' => 'Space Successfully deleted.',
        ]);
    }
}
