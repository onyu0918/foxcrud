<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bike;
use App\Http\Requests\BikeFormRequest;

class BikeController extends Controller
{
    //
    private static function getData() {
        return [
            ['id'=>1, 'name' => "S-Works Venge Di2-Sagan Collection", 'brand' =>'Specialized', 'price'=>'14,551,040원'],
            ['id'=>2, 'name' => "S-Works Tarmac SL7", 'brand' =>'Specialized', 'price'=>'18,738,901원'],
            ['id'=>3, 'name' => "Pinarello Dogma F12 Disk", 'brand' =>'Pinarello', 'price'=>'17,035,364원'],
            ['id'=>4, 'name' => "BMC Teammachine SLR 01 Disk", 'brand' =>'BMC', 'price'=>'20,584,399원']
        ];
    }

    public function index() {
        return view('bikes.index',[
            // 'bikes'=> self::getData(),
            'bikes'=> Bike::all(),
            'userInput'=> '<script>alert("목록조회성공")</script>'
        ]);
    }

    public function show(Bike $bike) {
        // $bikes = self::getData();
        // $key = array_search($bike,array_column($bikes,'id'));

        return view('bikes.show',[
            // 'bike'=> Bike::findOrFail($bike)
            'bike'=> $bike
        ]);
    }

    public function create() {
        return view('bikes.create');
    }

    public function store(BikeFormRequest $request) {
        $data = $request->validated();
        // $request->validate([
        //     'bike-name'=>'required',
        //     'bike-brand'=>'required',
        //     'bike-price'=>['required', 'integer']
        // ]);
        
        $bike = new Bike(); //Bike모델을 이용해서, db연결하고 그결과를 객체로 저장

        // $bike->name = strip_tags($request -> input('bike-name'));
        // $bike->brand = strip_tags($request -> input('bike-brand'));
        // $bike->price = strip_tags($request -> input('bike-price'));
        $bike->name = $data['bike-name'];
        $bike->brand = $data['bike-brand'];
        $bike->price = $data['bike-price'];

        $bike->save();
        return redirect()->route('bikes.index');
    }

    public function edit(Bike $id) {
        return view('bikes.edit',[
            'bike'=> $id
        ]);
    }
    
    public function update(Request $request, Bike $bike) {
        $request->validate([
            'bike-name'=>'required',
            'bike-brand'=>'required',
            'bike-price'=>['required', 'integer']
        ]);

        $bike->name = strip_tags($request -> input('bike-name'));
        $bike->brand = strip_tags($request -> input('bike-brand'));
        $bike->price = strip_tags($request -> input('bike-price'));

        $bike->save();
        return redirect()->route('bikes.show', $bike->id);
    }
        
}
