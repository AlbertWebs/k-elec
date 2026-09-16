@php
use App\Models\Setting;
@endphp

<!-- Floating WhatsApp Widget -->
@if(Setting::get('social_whatsapp'))
<div id="whatsapp-widget" class="fixed bottom-6 right-6 z-40">
    <!-- WhatsApp Button -->
    <button id="whatsapp-toggle" class="relative w-16 h-16 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg transition-all duration-300 transform hover:scale-110 flex items-center justify-center group">
        <i class="fab fa-whatsapp text-2xl"></i>
        
        <!-- Tooltip -->
        <div class="absolute bottom-20 right-0 bg-gray-800 text-white px-3 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
            Chat with us on WhatsApp
        </div>
    </button>

    <!-- WhatsApp Menu (Hidden by default) -->
    <div id="whatsapp-menu" class="absolute bottom-20 right-0 bg-white rounded-lg shadow-xl p-4 w-64 opacity-0 invisible transition-all duration-300 transform scale-95 origin-bottom-right" style="display: none;">
        <h3 class="text-gray-900 font-semibold mb-2">Hello! 👋</h3>
        <p class="text-gray-600 text-sm mb-4">How can we help you today? Feel free to reach out to us on WhatsApp for any enquiries or support.</p>
        
        <!-- Quick Messages -->
        <div class="space-y-2 mb-4">
            <button class="whatsapp-quick-msg w-full text-left px-3 py-2 rounded-lg hover:bg-green-50 text-sm text-gray-700 hover:text-green-600 transition-colors" data-message="Hi, I'd like to inquire about your products">
                <i class="fas fa-box text-green-500 mr-2"></i>Product Enquiry
            </button>
            <button class="whatsapp-quick-msg w-full text-left px-3 py-2 rounded-lg hover:bg-green-50 text-sm text-gray-700 hover:text-green-600 transition-colors" data-message="Hi, I need customer support">
                <i class="fas fa-headset text-green-500 mr-2"></i>Customer Support
            </button>
            <button class="whatsapp-quick-msg w-full text-left px-3 py-2 rounded-lg hover:bg-green-50 text-sm text-gray-700 hover:text-green-600 transition-colors" data-message="Hi, I'm interested in becoming a vendor">
                <i class="fas fa-handshake text-green-500 mr-2"></i>Vendor Enquiry
            </button>
            <button class="whatsapp-quick-msg w-full text-left px-3 py-2 rounded-lg hover:bg-green-50 text-sm text-gray-700 hover:text-green-600 transition-colors" data-message="Hi, I have a general enquiry">
                <i class="fas fa-comment text-green-500 mr-2"></i>General Enquiry
            </button>
        </div>
        
        <!-- Direct Chat Button -->
        <button id="whatsapp-start-chat" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-semibold text-center transition-colors">
            Start Chat
        </button>
    </div>
</div>

<style>
    /* Mobile responsiveness */
    @media (max-width: 640px) {
        #whatsapp-widget {
            bottom: 20px;
            right: 20px;
        }
        
        #whatsapp-menu {
            width: 280px;
            right: -10px;
        }
    }
    
    /* Animation for menu appearance */
    #whatsapp-menu.show {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const whatsappToggle = document.getElementById('whatsapp-toggle');
    const whatsappMenu = document.getElementById('whatsapp-menu');
    const quickMsgButtons = document.querySelectorAll('.whatsapp-quick-msg');
    const whatsappUrl = "{{ Setting::get('social_whatsapp') }}";
    
    if (!whatsappToggle || !whatsappMenu) {
        return;
    }
    
    // Extract phone number from WhatsApp URL and construct proper wa.me link
    function getWhatsAppLink(message) {
        return window.getProperWhatsAppLink(whatsappUrl, message);
    }
    
    // Toggle menu
    whatsappToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        const isVisible = whatsappMenu.style.display === 'block';
        
        if (isVisible) {
            whatsappMenu.style.display = 'none';
            whatsappMenu.classList.remove('show');
        } else {
            whatsappMenu.style.display = 'block';
            // Trigger reflow to enable transition
            whatsappMenu.offsetHeight;
            whatsappMenu.classList.add('show');
        }
    });
    
    // Quick message buttons
    quickMsgButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const message = this.dataset.message;
            const whatsappLink = getWhatsAppLink(message);
            
            window.open(whatsappLink, '_blank', 'noopener,noreferrer');
            
            // Close menu
            whatsappMenu.style.display = 'none';
            whatsappMenu.classList.remove('show');
        });
    });
    
    // Start Chat button
    const startChatBtn = document.getElementById('whatsapp-start-chat');
    if (startChatBtn) {
        startChatBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const whatsappLink = getWhatsAppLink('Hello, I would like to chat with you');
            
            window.open(whatsappLink, '_blank', 'noopener,noreferrer');
            
            // Close menu
            whatsappMenu.style.display = 'none';
            whatsappMenu.classList.remove('show');
        });
    }
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#whatsapp-widget')) {
            whatsappMenu.style.display = 'none';
            whatsappMenu.classList.remove('show');
        }
    });
});
</script>
@endif
