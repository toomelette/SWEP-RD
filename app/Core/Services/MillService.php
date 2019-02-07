<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\MillInterface;
use App\Core\BaseClasses\BaseService;


class MillService extends BaseService{


    protected $mill_repo;



    public function __construct(MillInterface $mill_repo){

        $this->mill_repo = $mill_repo;
        parent::__construct();

    }





    public function fetch($request){

        $mills = $this->mill_repo->fetch($request);

        $request->flash();
        return view('dashboard.mill.index')->with('mills', $mills);

    }






    public function store($request){

        $mill = $this->mill_repo->store($request);

        $this->event->fire('mill.store');
        return redirect()->back();

    }






    public function edit($slug){

        $mill = $this->mill_repo->findbySlug($slug);
        return view('dashboard.mill.edit')->with('mill', $mill);

    }






    public function update($request, $slug){

        $mill = $this->mill_repo->update($request, $slug);

        $this->event->fire('mill.update', $mill);
        return redirect()->route('dashboard.mill.index');

    }






    public function destroy($slug){

        $mill = $this->mill_repo->destroy($slug);

        $this->event->fire('mill.destroy', $mill);
        return redirect()->back();

    }






}