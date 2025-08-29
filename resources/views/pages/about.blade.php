@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">About Guru Digital</h1>
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
                        Founded in 2020, Guru Digital started with a simple mission: to make cutting-edge technology 
                        accessible to everyone in Kenya. What began as a small electronics shop has grown into one of 
                        the country's most trusted names in digital retail.
                    </p>
                    <p class="text-gray-600 mb-4">
                        We believe that technology should enhance lives, not complicate them. That's why we carefully 
                        curate our product selection, ensuring that every item we offer meets our high standards for 
                        quality, reliability, and value.
                    </p>
                    <p class="text-gray-600">
                        Today, we serve thousands of satisfied customers across Kenya, providing not just products, 
                        but complete digital solutions and exceptional customer service.
                    </p>
                </div>
                <div class="border border-gray-200 rounded-lg p-8 bg-gray-50">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-rocket text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Our Mission</h3>
                        <p class="text-gray-600 leading-relaxed">
                            To democratize technology by making premium electronics accessible, affordable, and 
                            easy to use for all Kenyans.
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

        <!-- Stats -->
        <div class="mb-16">
            <div class="bg-gradient-to-r from-blue-900 to-blue-800 rounded-lg p-8 text-white">
                <h2 class="text-3xl font-bold text-center mb-8">Our Numbers</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
                    <div>
                        <div class="text-3xl font-bold mb-2">10,000+</div>
                        <div class="text-blue-200 text-sm">Happy Customers</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold mb-2">500+</div>
                        <div class="text-blue-200 text-sm">Products</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold mb-2">3+</div>
                        <div class="text-blue-200 text-sm">Years Experience</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold mb-2">24/7</div>
                        <div class="text-blue-200 text-sm">Support</div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Why Choose Us -->
        <div>
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Why Choose Guru Digital?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-truck text-orange-600 text-lg"></i>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900 mb-2">Fast Delivery</h3>
                    <p class="text-gray-600 text-sm">Free shipping on orders over KES 50,000</p>
                </div>
                
                <div class="text-center">
                    <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-undo text-green-600 text-lg"></i>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900 mb-2">Easy Returns</h3>
                    <p class="text-gray-600 text-sm">30-day return policy on all products</p>
                </div>
                
                <div class="text-center">
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-blue-600 text-lg"></i>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900 mb-2">24/7 Support</h3>
                    <p class="text-gray-600 text-sm">Round-the-clock customer support</p>
                </div>
                
                <div class="text-center">
                    <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-purple-600 text-lg"></i>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900 mb-2">Warranty</h3>
                    <p class="text-gray-600 text-sm">Comprehensive warranty on all products</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 