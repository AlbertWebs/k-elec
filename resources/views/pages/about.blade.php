@extends('layouts.app')

@section('content')
{{-- styles --}}
<style>
  .min-height-100 {
    min-height: 100px; /* Adjust the value as needed */
  }
  .min-height-heading{
    min-height: 64px; 
    font-weight: 800 !important;
  }
</style>
{{-- Image --}}
<section 
  class="relative bg-center bg-no-repeat py-16 px-6 text-white flex items-center justify-center" 
  style="
    width: 100%;
    margin: 0 auto;
    background-image: url('{{ url('/') }}/uploads/About-Us-Slider.jpg');
    background-repeat: no-repeat;
    background-size: contain;
    background-position: center;
    aspect-ratio: 16/9;
  "
>
  <!-- Overlay -->
  <div class="absolute inset-0 bg-black/50"></div>

  <div class="relative max-w-7xl mx-auto text-center">
    <h1 class="text-4xl font-bold mb-4">
      {{-- Title --}}
    </h1>
  </div>
</section>

<section class="bg-gray-800 ">
    <div ion class="py-16   container mx-auto flex-row ">

        {{--  --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
  <!-- Card -->
  <div class="bg-gray-900 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition flex flex-col">
    <div class="p-6 flex flex-col justify-between h-full min-h-[320px]">
      <h3 class="text-2xl font-extrabold text-white mb-4">Our Vision: Korean Excellence for Every Home</h3>
      <p class="text-gray-400 text-sm">
        In a market dominated by extremes, K-Elec offers a smarter choice. We bridge the
        gap between uncompromising quality and accessible prices, driven by a single
        mission: to deliver genuine Korean engineering excellence to households worldwide.
        Every K-Elec product embodies the innovation, thoughtful design, and trusted
        reliability that defines the best of Korean technology.
      </p>
    </div>
    <img src="{{ url('/') }}/uploads/About-Us-Slider.jpg" alt="Service 1" class="w-full h-56 object-cover">
  </div>

  <!-- Card -->
  <div class="bg-gray-900 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition flex flex-col">
    <div class="p-6 flex flex-col justify-between h-full min-h-[320px]">
      <h3 class="text-2xl font-extrabold text-white mb-4">The Core of Our Innovation: Our R&D Partnership with Neurosys</h3>
      <p class="text-gray-400 text-sm">
        The soul of every K-Elec appliance is its core technology. To ensure world-class
        performance, K-Elec proudly collaborates with one of Korea's leading electronic
        R&D powerhouses: Neurosys. At their advanced R&D center in Korea, Neurosys's
        expert engineers develop, test, and perfect the core PCBs (Printed Circuit Boards)
        that function as the 'brain' inside our refrigerators and TVs. This strategic
        partnership is the foundation of our technological edge.
      </p>
    </div>
    <img src="{{ url('/') }}/uploads/About-Us-Slider.jpg" alt="Service 2" class="w-full h-56 object-cover">
  </div>

  <!-- Card -->
  <div class="bg-gray-900 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition flex flex-col">
    <div class="p-6 flex flex-col justify-between h-full min-h-[320px]">
      <h3 class="text-2xl font-extrabold text-white mb-4">Designed in Korea, For Your Life</h3>
      <p class="text-gray-400 text-sm">
        Our collaboration with Neurosys is rooted in a shared design philosophy:
        technology must serve people. This partnership allows us to infuse every product
        with features that matter—from energy-saving intelligence in our refrigerators to
        flawless visual processing in our TVs. The result is a seamless blend of modern
        aesthetics and practical innovation, conceived in Korea and crafted for your
        everyday life.
      </p>
    </div>
    <img src="{{ url('/') }}/uploads/About-Us-Slider.jpg" alt="Service 3" class="w-full h-56 object-cover">
  </div>

  <!-- Card -->
  <div class="bg-gray-900 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition flex flex-col">
    <div class="p-6 flex flex-col justify-between h-full min-h-[320px]">
      <h3 class="text-2xl font-extrabold text-white mb-4">Innovation for Everyday Life</h3>
      <p class="text-gray-400 text-sm">
        We believe technology should make life easier, healthier, and smarter.
        This core belief is the driving force behind our collaboration with our Korean R&D
        partner, Neurosys. Their expertise in advanced electronics allows us to build
        intelligent features directly into our products—creating refrigerators that optimize
        cooling for ultimate freshness and TVs that deliver a stunningly immersive sound
        experience. It’s how we ensure every K-Elec appliance delivers on its promise:
        genuine Korean innovation, designed for your everyday life.
      </p>
    </div>
    <img src="{{ url('/') }}/uploads/About-Us-Slider.jpg" alt="Service 4" class="w-full h-56 object-cover">
  </div>
</div>

        {{--  --}}


    </div>
</section>

<section class="bg-gray-800 ">
<div ion class="py-16   container mx-auto flex-row ">
  <div class="max-w-5xl mx-auto mb-12">
    <h2 class="text-3xl font-bold text-white font-extrabold">Our Technology Hub: A Glimpse into the Neurosys R&D Center</h2>
    <p class="text-gray-300 mt-2">
        Since 2000, Neurosys has been a trusted leader in electronic control systems for major Korean appliance brands.
        Their state-of-the-art labs are where K-Elec's product concepts are transformed into reliable technology. This deep-rooted expertise
        ensures every K-Elec product is built on a foundation of proven Korean engineering excellence. The images below offer a window
        into the home of our innovation.
    </p>
  </div>

 
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto py-16 px-6 bg-gray-800">
  
  <!-- Column 1: One tall image -->
  <div class="overflow-hidden rounded-xl shadow-lg">
    <img src="{{ url('/') }}/uploads/About-Us-Slider.jpg" 
         alt="K-Elec Vision" 
         class="w-full h-full object-cover hover:scale-105 transition duration-500">
  </div>

  <!-- Column 2: Two stacked images -->
  <div class="grid grid-rows-2 gap-6">
    <div class="overflow-hidden rounded-xl shadow-lg">
      <img src="{{ url('/') }}/uploads/About-Us-Slider.jpg" 
           alt="Neurosys R&D" 
           class="w-full h-full object-cover hover:scale-105 transition duration-500">
    </div>
    <div class="overflow-hidden rounded-xl shadow-lg">
      <img src="{{ url('/') }}/uploads/About-Us-Slider.jpg" 
           alt="PCB Technology" 
           class="w-full h-full object-cover hover:scale-105 transition duration-500">
    </div>
  </div>

  <!-- Column 3: Two stacked images -->
  <div class="grid grid-rows-2 gap-6">
    <div class="overflow-hidden rounded-xl shadow-lg">
      <img src="{{ url('/') }}/uploads/About-Us-Slider.jpg" 
           alt="Korean Design" 
           class="w-full h-full object-cover hover:scale-105 transition duration-500">
    </div>
    <div class="overflow-hidden rounded-xl shadow-lg">
      <img src="{{ url('/') }}/uploads/About-Us-Slider.jpg" 
           alt="Smart Home Tech" 
           class="w-full h-full object-cover hover:scale-105 transition duration-500">
    </div>
  </div>
  </div>
</div>

</section>



@endsection 