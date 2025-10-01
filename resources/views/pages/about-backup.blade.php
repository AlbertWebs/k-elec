@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">About K-Elec</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                We are Kenya's premier destination for cutting-edge electronics and digital solutions, 
                committed to bringing the latest technology to our customers.
            </p>
        </div>

        <!-- Company Story -->
        <div class="mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Story</h2>
                    <p class="text-gray-600 mb-4">
                        <strong>K-Elec,</strong> one of the largest Korean electronics companies, was founded with its global head office in Seoul, Korea.<br><br>
                        As a trusted home appliance brand backed by industry-leading Korean technology, K-Elec has expanded its presence beyond Korea to the Middle East and Africa. Our mission is to supply <strong>“Best Quality, Made in Korea, Electronics”</strong> to households and businesses worldwide. Guided by passion for technology and innovation, we remain committed to driving industrial transformation and offering customers reliable, cutting-edge products.<br><br>
                        With years of strategic growth, K-Elec has firmly established advanced manufacturing facilities in Korea and built international operations across the Middle East & Africa. To support efficient regional distribution, a headquarters was set up in Dubai, UAE, while our networks have extended to over 15 countries including <strong>Kenya, Ethiopia, Tanzania, Zambia, Djibouti, Senegal, Angola, and beyond.</strong><br><br>
                        <strong>K-Elec Kenya</strong> serves as the brand’s stronghold in East Africa. We are dedicated to providing Kenyan households and businesses with modern, energy-efficient, and durable appliances tailored to local needs. Our goal is to deliver not only world-class products but also exceptional after-sales service and customer satisfaction that Kenyans can trust.<br><br>
                        Most importantly, K-Elec will never stop innovating. Through our reliable and outstanding products, we aim to create meaningful experiences and bring new excitement to Kenyan families and enterprises alike.
                    </p>
                    
                </div>
                <div class="border border-gray-200 rounded-lg p-8 bg-gray-50">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-rocket text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Our Mission</h3>
                        <p class="text-gray-600 leading-relaxed">
                            To enrich people’s lives by providing reliable and innovative Korean technology, making premium electronics accessible, trusted, and inspiring, while delivering groundbreaking customer experiences and ensuring unlimited satisfaction for all. We are driven by a passion for excellence and a commitment to brighten every home and community we serve.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Values -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Our Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="border border-gray-200 rounded-lg p-6 text-center bg-gray-50">
                    <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-green-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Quality</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        We never compromise on quality. Every product we offer is carefully selected and tested 
                        to ensure it meets our high standards.
                    </p>
                </div>
                
                <div class="border border-gray-200 rounded-lg p-6 text-center bg-gray-50">
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Customer First</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Our customers are at the heart of everything we do. We're committed to providing 
                        exceptional service and support.
                    </p>
                </div>
                
                <div class="border border-gray-200 rounded-lg p-6 text-center bg-gray-50">
                    <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-lightbulb text-purple-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Innovation</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        We stay ahead of the curve, constantly exploring new technologies and trends 
                        to bring you the latest innovations.
                    </p>
                </div>
            </div>
        </div>

        @include('components.showrooms-card')

   

        
    </div>
</div>
@endsection 