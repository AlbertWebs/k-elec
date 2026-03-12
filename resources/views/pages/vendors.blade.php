@extends('layouts.app')

@section('title', 'Partner with K-Elec - Become a Vendor')
@section('description', 'Join K-Elec\'s partner network. We\'re looking for retailers, distributors, and corporate partners. Submit your inquiry today to grow your business with us.')
@section('keywords', 'vendor, partnership, retailer, distributor, B2B, wholesale')
@section('og_title', 'Partner with K-Elec - Become a Vendor')
@section('og_description', 'Join K-Elec\'s partner network and grow your business with us.')
@section('og_type', 'website')

@section('content')
<div class="bg-gray-50">
    <!-- Hero Section -->
    <section class="bg-red-600 text-white py-12 sm:py-16 lg:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-3 sm:mb-4">
                    Partner with K-Elec
                </h1>
                <p class="text-base sm:text-lg lg:text-xl text-red-100 mb-6 sm:mb-8">
                    Join Kenya's leading electronics retailer. We're seeking vendors, retailers, distributors, and corporate partners to expand our network and serve more customers.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-2 text-xs sm:text-sm text-red-100">
                    <i class="fas fa-handshake"></i>
                    <span>Grow Your Business • Expand Your Market</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 sm:py-16 lg:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 items-center">
                <!-- Left Column - Form -->
                <div class="order-2 lg:order-1">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 lg:p-10">
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                            Submit Your Inquiry
                        </h2>
                        <p class="text-sm sm:text-base text-gray-600 mb-6 sm:mb-8">
                            Tell us about your business and partnership interests. We'll review your submission and be in touch shortly.
                        </p>

                        @if(session('success'))
                            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-start">
                                <i class="fas fa-check-circle mr-3 mt-0.5 flex-shrink-0"></i>
                                <div>
                                    <p class="font-semibold">Success!</p>
                                    <p class="text-sm">{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        <form id="vendor-form" 
                              method="POST" 
                              data-action="{{ route('vendors.store') }}"
                              class="space-y-5">
                            @csrf
                            
                            <!-- Contact Person Name -->
                            <div>
                                <label for="vendor-contact-name" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">
                                    Contact Person Name *
                                </label>
                                <div class="relative">
                                    <i class="fas fa-user absolute left-3 top-3.5 text-gray-400"></i>
                                    <input 
                                        type="text" 
                                        id="vendor-contact-name" 
                                        name="contact_person_name" 
                                        required 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                        placeholder="John Doe">
                                </div>
                            </div>

                            <!-- Business Name -->
                            <div>
                                <label for="vendor-business-name" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">
                                    Business Name *
                                </label>
                                <div class="relative">
                                    <i class="fas fa-building absolute left-3 top-3.5 text-gray-400"></i>
                                    <input 
                                        type="text" 
                                        id="vendor-business-name" 
                                        name="business_name" 
                                        required 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                        placeholder="Your Business Ltd">
                                </div>
                            </div>

                            <!-- Email Input -->
                            <div>
                                <label for="vendor-email" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">
                                    Email Address *
                                </label>
                                <div class="relative">
                                    <i class="fas fa-envelope absolute left-3 top-3.5 text-gray-400"></i>
                                    <input 
                                        type="email" 
                                        id="vendor-email" 
                                        name="email" 
                                        required 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                        placeholder="contact@business.com">
                                </div>
                            </div>

                            <!-- Phone Input -->
                            <div>
                                <label for="vendor-phone" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">
                                    Phone Number *
                                </label>
                                <div class="relative">
                                    <i class="fas fa-phone absolute left-3 top-3.5 text-gray-400"></i>
                                    <input 
                                        type="tel" 
                                        id="vendor-phone" 
                                        name="phone" 
                                        required 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                        placeholder="+254 700 123 456">
                                </div>
                            </div>

                            <!-- Location -->
                            <div>
                                <label for="vendor-location" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">
                                    Location / City *
                                </label>
                                <div class="relative">
                                    <i class="fas fa-map-marker-alt absolute left-3 top-3.5 text-gray-400"></i>
                                    <input 
                                        type="text" 
                                        id="vendor-location" 
                                        name="location" 
                                        required 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                        placeholder="Nairobi">
                                </div>
                            </div>

                            <!-- Partnership Type -->
                            <div>
                                <label for="vendor-partnership-type" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">
                                    Partnership Type *
                                </label>
                                <select 
                                    id="vendor-partnership-type" 
                                    name="partnership_type" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                    <option value="">Select a partnership type</option>
                                    <option value="retail_shop">Retail Shop Owner</option>
                                    <option value="distributor">Distributor</option>
                                    <option value="corporate_purchase">Corporate Purchase</option>
                                    <option value="real_estate">Real Estate / Furnishing</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Other Details (Conditional) -->
                            <div id="vendor-other-details-container" class="hidden">
                                <label for="vendor-other-details" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">
                                    Please Specify *
                                </label>
                                <textarea 
                                    id="vendor-other-details" 
                                    name="other_details" 
                                    rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                    placeholder="Tell us about your partnership interests..."></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button 
                                type="submit" 
                                class="w-full bg-red-600 text-white py-2.5 sm:py-3 px-4 sm:px-6 rounded-lg font-semibold hover:bg-gray-600 transition-colors duration-200 flex items-center justify-center space-x-2 text-sm sm:text-base">
                                <i class="fas fa-paper-plane"></i>
                                <span>Submit Inquiry</span>
                            </button>

                            <!-- Terms -->
                            <p class="text-xs text-gray-600 text-center leading-relaxed">
                                By submitting, you agree to be contacted about partnership opportunities.
                                <a href="{{ route('pages.privacy') }}" class="text-red-600 hover:text-red-700 font-semibold">Privacy Policy</a>
                            </p>
                        </form>

                        <!-- Message Container -->
                        <div id="vendor-message" class="hidden mt-6"></div>
                    </div>
                </div>

                <!-- Right Column - Benefits -->
                <div class="order-1 lg:order-2">
                    <div class="mb-8 sm:mb-12">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-6 sm:mb-8">
                            Why Partner with K-Elec?
                        </h3>

                        <!-- Benefit Cards -->
                        <div class="space-y-3 sm:space-y-5">
                            <!-- Benefit 1 -->
                            <div class="flex items-start space-x-3 sm:space-x-4 p-3 sm:p-4 rounded-lg bg-white border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12 rounded-md bg-red-100">
                                        <i class="fas fa-chart-line text-red-600 text-base sm:text-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-base sm:text-lg font-semibold text-gray-900">Grow Your Sales</h4>
                                    <p class="text-gray-600 text-xs sm:text-sm mt-1">
                                        Access to our extensive customer network and marketing channels to boost your revenue.
                                    </p>
                                </div>
                            </div>

                            <!-- Benefit 2 -->
                            <div class="flex items-start space-x-3 sm:space-x-4 p-3 sm:p-4 rounded-lg bg-white border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12 rounded-md bg-red-100">
                                        <i class="fas fa-award text-red-600 text-base sm:text-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-base sm:text-lg font-semibold text-gray-900">Premium Support</h4>
                                    <p class="text-gray-600 text-xs sm:text-sm mt-1">
                                        Dedicated account managers and technical support to ensure your success.
                                    </p>
                                </div>
                            </div>

                            <!-- Benefit 3 -->
                            <div class="flex items-start space-x-3 sm:space-x-4 p-3 sm:p-4 rounded-lg bg-white border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12 rounded-md bg-red-100">
                                        <i class="fas fa-boxes text-red-600 text-base sm:text-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-base sm:text-lg font-semibold text-gray-900">Competitive Margins</h4>
                                    <p class="text-gray-600 text-xs sm:text-sm mt-1">
                                        Attractive wholesale prices and flexible payment terms for our partners.
                                    </p>
                                </div>
                            </div>

                            <!-- Benefit 4 -->
                            <div class="flex items-start space-x-3 sm:space-x-4 p-3 sm:p-4 rounded-lg bg-white border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12 rounded-md bg-red-100">
                                        <i class="fas fa-truck text-red-600 text-base sm:text-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-base sm:text-lg font-semibold text-gray-900">Reliable Logistics</h4>
                                    <p class="text-gray-600 text-xs sm:text-sm mt-1">
                                        Fast, reliable delivery across Kenya with real-time tracking.
                                    </p>
                                </div>
                            </div>

                            <!-- Benefit 5 -->
                            <div class="flex items-start space-x-3 sm:space-x-4 p-3 sm:p-4 rounded-lg bg-white border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12 rounded-md bg-red-100">
                                        <i class="fas fa-graduation-cap text-red-600 text-base sm:text-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-base sm:text-lg font-semibold text-gray-900">Training & Resources</h4>
                                    <p class="text-gray-600 text-xs sm:text-sm mt-1">
                                        Product training and marketing materials to help you succeed.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partnership Types Section -->
    <section class="py-12 sm:py-16 lg:py-20 border-t border-gray-200">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 sm:mb-4">
                    Partnership Types
                </h2>
                <p class="text-gray-600 text-sm sm:text-base lg:text-lg max-w-2xl mx-auto">
                    K-Elec partners with various types of businesses to meet diverse market needs.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-6">
                <!-- Retail Shop -->
                <div class="bg-white rounded-lg border border-gray-200 p-5 sm:p-6 hover:shadow-lg transition-shadow">
                    <div class="text-center">
                        <div class="inline-block bg-red-100 rounded-full p-3 sm:p-4 mb-3 sm:mb-4">
                            <i class="fas fa-shop text-red-600 text-2xl sm:text-3xl"></i>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2">Retail Shops</h3>
                        <p class="text-xs sm:text-sm text-gray-600">Local electronics shops and convenience stores</p>
                    </div>
                </div>

                <!-- Distributor -->
                <div class="bg-white rounded-lg border border-gray-200 p-5 sm:p-6 hover:shadow-lg transition-shadow">
                    <div class="text-center">
                        <div class="inline-block bg-red-100 rounded-full p-3 sm:p-4 mb-3 sm:mb-4">
                            <i class="fas fa-network-wired text-red-600 text-2xl sm:text-3xl"></i>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2">Distributors</h3>
                        <p class="text-xs sm:text-sm text-gray-600">Regional and national distribution partners</p>
                    </div>
                </div>

                <!-- Corporate -->
                <div class="bg-white rounded-lg border border-gray-200 p-5 sm:p-6 hover:shadow-lg transition-shadow">
                    <div class="text-center">
                        <div class="inline-block bg-red-100 rounded-full p-3 sm:p-4 mb-3 sm:mb-4">
                            <i class="fas fa-briefcase text-red-600 text-2xl sm:text-3xl"></i>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2">Corporate</h3>
                        <p class="text-xs sm:text-sm text-gray-600">B2B sales and bulk purchases</p>
                    </div>
                </div>

                <!-- Real Estate -->
                <div class="bg-white rounded-lg border border-gray-200 p-5 sm:p-6 hover:shadow-lg transition-shadow">
                    <div class="text-center">
                        <div class="inline-block bg-red-100 rounded-full p-3 sm:p-4 mb-3 sm:mb-4">
                            <i class="fas fa-home text-red-600 text-2xl sm:text-3xl"></i>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2">Real Estate</h3>
                        <p class="text-xs sm:text-sm text-gray-600">Home furnishing and fit-out contractors</p>
                    </div>
                </div>

                <!-- Other -->
                <div class="bg-white rounded-lg border border-gray-200 p-5 sm:p-6 hover:shadow-lg transition-shadow">
                    <div class="text-center">
                        <div class="inline-block bg-red-100 rounded-full p-3 sm:p-4 mb-3 sm:mb-4">
                            <i class="fas fa-ellipsis-h text-red-600 text-2xl sm:text-3xl"></i>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2">Other</h3>
                        <p class="text-xs sm:text-sm text-gray-600">Unique partnership opportunities</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const partnershipTypeSelect = document.getElementById('vendor-partnership-type');
    const otherDetailsContainer = document.getElementById('vendor-other-details-container');
    const otherDetailsInput = document.getElementById('vendor-other-details');

    // Toggle visibility of other details field
    function toggleOtherDetails() {
        if (partnershipTypeSelect.value === 'other') {
            otherDetailsContainer.classList.remove('hidden');
            otherDetailsInput.setAttribute('required', 'required');
        } else {
            otherDetailsContainer.classList.add('hidden');
            otherDetailsInput.removeAttribute('required');
            otherDetailsInput.value = '';
        }
    }

    partnershipTypeSelect.addEventListener('change', toggleOtherDetails);

    // Initialize vendor form
    const vendorForm = document.getElementById('vendor-form');
    let vendorFormInitialized = false;

    if (vendorForm && !vendorFormInitialized) {
        vendorFormInitialized = true;

        vendorForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const submitBtn = vendorForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Submitting...</span>';

            const formData = new FormData(vendorForm);

            try {
                const response = await fetch(vendorForm.dataset.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData
                });

                const data = await response.json();

                const messageContainer = document.getElementById('vendor-message');

                if (data.success) {
                    messageContainer.className = 'mt-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-start';
                    messageContainer.innerHTML = `
                        <i class="fas fa-check-circle mr-3 mt-0.5 flex-shrink-0"></i>
                        <div>
                            <p class="font-semibold">Success!</p>
                            <p class="text-sm">Thank you for your inquiry. We'll review your submission and contact you soon.</p>
                        </div>
                    `;
                    messageContainer.classList.remove('hidden');
                    vendorForm.reset();
                    otherDetailsContainer.classList.add('hidden');

                    // Scroll to message
                    setTimeout(() => {
                        messageContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }, 100);
                } else if (data.errors) {
                    let errorHtml = '<ul class="list-disc list-inside text-sm">';
                    for (let field in data.errors) {
                        if (Array.isArray(data.errors[field])) {
                            data.errors[field].forEach(error => {
                                errorHtml += `<li>${error}</li>`;
                            });
                        } else {
                            errorHtml += `<li>${data.errors[field]}</li>`;
                        }
                    }
                    errorHtml += '</ul>';

                    messageContainer.className = 'mt-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg';
                    messageContainer.innerHTML = `
                        <div>
                            <p class="font-semibold mb-2">Please check the following:</p>
                            ${errorHtml}
                        </div>
                    `;
                    messageContainer.classList.remove('hidden');
                }
            } catch (error) {
                const messageContainer = document.getElementById('vendor-message');
                messageContainer.className = 'mt-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg';
                messageContainer.innerHTML = `
                    <div>
                        <p class="font-semibold">Error!</p>
                        <p class="text-sm">There was an error submitting your inquiry. Please try again.</p>
                    </div>
                `;
                messageContainer.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    }
});
</script>
@endsection
