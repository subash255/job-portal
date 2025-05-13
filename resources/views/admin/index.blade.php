@extends('layouts.app')
@section('content')
    
    <!-- Cards Section -->
    <div class="relative grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-3 mx-4 z-20 rounded-lg">
       
        
  

        <div
            class="bg-white p-6 rounded-lg text-left hover:shadow-2xl transition-shadow duration-300 flex flex-row items-center justify-between w-full h-20 transform sm:-translate-y-8 lg:-translate-y-12 shadow-lg">
            <div>
                <h2 class="text-gray-700 font-medium mb-2">Total company</h2>
                <p class="text-gray-700 font-medium">2</p>
            </div>
            <div class="bg-purple-600 text-white w-12 h-12 flex items-center justify-center rounded-full">
                <i class="ri-money-dollar-circle-fill text-2xl"></i>
            </div>
        </div>

        <div
            class="bg-white p-6 rounded-lg text-left hover:shadow-2xl transition-shadow duration-300 flex flex-row items-center justify-between w-full h-20 transform sm:-translate-y-4 lg:-translate-y-8 shadow-lg">
            <div>
                <h2 class="text-gray-700 font-medium mb-2">Jobs</h2>
                <p class="text-gray-700 font-medium">10</p>
            </div>
            <div class="bg-green-500 text-white w-12 h-12 flex items-center justify-center rounded-full">
                <i class="ri-shopping-cart-fill text-2xl"></i>
            </div>
        </div>



        <div
            class="bg-white p-6 rounded-lg text-left hover:shadow-2xl transition-shadow duration-300 flex flex-row items-center justify-between w-full h-20 transform sm:-translate-y-4 lg:-translate-y-8 shadow-lg">
            <div>
                <h2 class="text-gray-700 font-medium mb-2">Visitors</h2>
                <p class="text-gray-700 font-medium">100</p>
            </div>
            <div class="bg-red-500 text-white w-12 h-12 flex items-center justify-center rounded-full">
                <i class="ri-earth-fill text-2xl"></i>
            </div>
        </div>
    </div>

   

    
@endsection
