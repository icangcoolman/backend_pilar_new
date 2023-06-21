<?php

namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\City;
use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;



class BackendController extends Controller
{
    public function index(){
        return view('index', [
            'title_page' => 'Backend Dashboard',
            'title' => 'Halaman Dashboard Admin',
        ]);
    }

    //Begin Manajemen Kota

    public function browsekota(){
        $kota = City::all();
        return view('index', [
            'title_page' => 'Manajemen Kota',
            'title' => 'Halaman Manajemen Kota',
            'datakota' => $kota,
        ]);
    }

    public function addkota(Request $request){
        $validator = \Validator::make($request->all(), [
            'kota' => 'required|min:3',
        ]);

        //echo $request->kota;
        //exit;

        if ($validator->fails())
        {
            //return response()->json(['errors'=>$validator->errors()->all()]);
            return redirect('/browsekota')->withInput()->withErrors($validator);
        }

        $dataku= new City();
        //exit;

        $dataku->city=$request->kota;
        $dataku->save();
   
        //return response()->json(['success'=>'Data Berhasil Ditambah']);
        return redirect('/browsekota')->with('success', 'Data Berhasil Disimpan');
    }

    //End Manajemen Kota


    //Begin Manajemen Mobil

    public function browsemobil(){
        $mobil = Car::all();
        return view('index', [
            'title_page' => 'Manajemen Mobil',
            'title' => 'Halaman Manajemen Mobil',
            'datamobil' => $mobil,
        ]);
    }

    public function addmobil(Request $request){
        $validator = \Validator::make($request->all(), [
            'mobil' => 'required|min:3',
        ]);

        //echo $request->kota;
        //exit;

        if ($validator->fails())
        {
            //return response()->json(['errors'=>$validator->errors()->all()]);
            return redirect('/browsemobil')->withInput()->withErrors($validator);
        }

        $dataku= new Car();
        //exit;

        $dataku->car=$request->mobil;
        $dataku->save();
   
        //return response()->json(['success'=>'Data Berhasil Ditambah']);
        return redirect('/browsemobil')->with('success', 'Data Berhasil Disimpan');
    }

    //End Manajemen Mobil

     //Begin Manajemen Biaya

    public function browsebiaya(){
        $kota = City::all();
        $mobil = Car::all();

        
        if(request('q_kotaasal') || request('q_kotatujuan') || request('q_kendaraan')){
            $result = Info::query();

            if (!empty(request('q_kotaasal'))) {
                $result = $result->where('city_id_1', '=', request('q_kotaasal'));
            }

            if (!empty(request('q_kotatujuan'))) {
                $result = $result->where('city_id_2', request('q_kotatujuan'));
            }

            if (!empty(request('q_kendaraan'))) {
                $result = $result->where('car_id', request('q_kendaraan'));
            }

            $info = $result->get();
        } else {
            $info = Info::all();
        }
        //$info = Info::latest(). $param_kotaasal;
        return view('index', [
            'title_page' => 'Manajemen Biaya',
            'title' => 'Halaman Manajemen Biaya',
            'datakota' => $kota,
            'datamobil' => $mobil,
            'datainfo' => $info,
        ]);
    }


    public function addbiaya(Request $request){
        $validator = \Validator::make($request->all(), [
            'kotaasal' => 'required',
            'kotatujuan' => 'required',
            'kendaraan' => 'required',
            'harga' => 'required',
        ]);

        //echo $request->kota;
        //exit;

        if ($validator->fails())
        {
            //return response()->json(['errors'=>$validator->errors()->all()]);
            return redirect('/browsebiaya')->withInput()->withErrors($validator);
        }

        $dataku= new Info();
        //exit;

        $dataku->city_id_1=$request->kotaasal;
        $dataku->city_id_2=$request->kotatujuan;
        $dataku->car_id=$request->kendaraan;
        $dataku->price=$request->harga;
        $dataku->save();
   
        //return response()->json(['success'=>'Data Berhasil Ditambah']);
        return redirect('/browsebiaya')->with('success', 'Data Berhasil Disimpan');
    }

    public function editbiaya(Request $request){
        $kota = City::all();
        $mobil = Car::all();
        $info = Info::all();
        $info_selected = Info::where('id',$request->id)->get();
        return view('index', [
            'title_page' => 'Manajemen Biaya',
            'title' => 'Halaman Manajemen Biaya',
            'datakota' => $kota,
            'datamobil' => $mobil,
            'datainfo' => $info,
            'datagetinfo' => $info_selected,
            'id' => $request->id,
        ]);
    }

    public function actioneditbiaya(Request $request){
        $validator = \Validator::make($request->all(), [
            'kotaasal' => 'required',
            'kotatujuan' => 'required',
            'kendaraan' => 'required',
            'harga' => 'required',
        ]);

        //echo $request->kota;
        //exit;

        if ($validator->fails())
        {
            //return response()->json(['errors'=>$validator->errors()->all()]);
            return redirect('/browsebiaya')->withInput()->withErrors($validator);
        }

        $dataku = Info::find($request->id);
    
        $dataku->city_id_1=$request->kotaasal;
        $dataku->city_id_2=$request->kotatujuan;
        $dataku->car_id=$request->kendaraan;
        $dataku->price=$request->harga;
        $dataku->save();
   
        //return response()->json(['success'=>'Data Berhasil Ditambah']);
        return redirect('/browsebiaya/'.$request->id)->with('success', 'Data Berhasil Disimpan');
    }

    public function actiondeletebiaya(Request $request){
        $id = $request->get('id');
        //echo $id;
        //exit;
        $info = Info::find($id);
        //echo $category[0]->id.'- coolman';
        $info->delete();
        return redirect('/browsebiaya/')->with('success', 'Data Berhasil Dihapus');
    }

     //Begin Manajemen Biaya

     //Authentications

     public function login()
     {
        return view('login.login', [
            'title_page' => 'Form Login',
            'title' => 'Halaman Login Administrator',
        ]);
     }

     public function actionlogin(Request $request){
        //dd($request->all());
        $credentials = $request->validate([
            'email' => 'required|min:5',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            return redirect('/');
        }
        return back()->with('loginError', 'Login Failed!');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }


}
