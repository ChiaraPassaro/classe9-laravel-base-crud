<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shoe;

class ShoeController extends Controller
{

    private $validationShoe = [
        'brand' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'color' => 'required|string|max:255',
        'material' => 'required|string|max:255',
        'description' => 'required|string',
        'size' => 'required|numeric|min:30|max:50',
        'price' => 'required|numeric|min:1|max:9999.99',
        'date_production' => 'required|date',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shoes = Shoe::all();

        return view('shoes.index', compact('shoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shoes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'brand' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'material' => 'required|string|max:255',
            'description' => 'required|string',
            'size' => 'required|numeric|min:30|max:50',
            'price' => 'required|numeric|min:1|max:9999.99',
            'date_production' => 'required|date',
            ]);

        $newShoe = new Shoe;
        // $newShoe->brand = $data['brand'];
        // $newShoe->size = $data['size'];
        // $newShoe->color = $data['color'];
        // $newShoe->type = $data['type'];
        // $newShoe->material = $data['material'];
        // $newShoe->description = $data['description'];
        // $newShoe->price = $data['price'];
        // $newShoe->date_production = $data['date_production'];
        $newShoe->fill($data);
        $saved = $newShoe->save();

        if ($saved) {
            // $shoe = Shoe::orderBy('id','desc')->first();
            $shoe = Shoe::all()->last();
            return redirect()->route('shoes.show', compact('shoe'));
        }

        dd('Non salvato');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $shoe = Shoe::find($id);

    //     if(empty($shoe)) {
    //         abort('404');
    //     }

    //     return view('shoes.show', compact('shoe'));
    // }

    public function show(Shoe $shoe)
    {
        //$shoe = Shoe::find($id);

        if(empty($shoe)) {
            abort('404');
        }

        return view('shoes.show', compact('shoe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Shoe $shoe)
    {
        if (empty($shoe)) {
            abort('404');
        }

        return view('shoes.create', compact('shoe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shoe = Shoe::find($id);
        if(empty($shoe)) {
            abort('404');
        }

        $data = $request->all();
        $request->validate($this->validationShoe);
        $updated = $shoe->update($data);
        if ($updated) {
            $shoe = Shoe::find($id);
            return redirect()->route('shoes.show', compact('shoe'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shoe $shoe)
    { 
        $id = $shoe->id;
        $deleted = $shoe->delete();
        $data = [
            'id' => $id,
            'shoes' => Shoe::all()
        ];
        
        return view('shoes.index', $data);
    }
}
