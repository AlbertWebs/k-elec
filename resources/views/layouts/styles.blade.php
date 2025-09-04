<style>
.carousel-container {
    position: relative;
    overflow: hidden;
    width: 100%;
    height: 600px; /* adjust for your design */
}

.carousel-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transform: translateX(100%);
    transition: all 1s ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
}

.carousel-slide.active {
    opacity: 1;
    transform: translateX(0);
    z-index: 10;
}

.carousel-slide.prev {
    transform: translateX(-100%);
}

.carousel-btn {
    z-index: 20;
}

.carousel-dot {
    cursor: pointer;
}
.carousel-slide {
    background-attachment: fixed;
    background-position: center;
}

.mobile-slider {
    min-height:350px;
    background-size: contain;
    background-position: center;
}

@media (max-width: 1024px) {
    .carousel-container {
        height: 400px;
    }
    .carousel-slide h2 {
        font-size: 2rem !important;
    }
    .carousel-slide p {
        font-size: 1rem !important;
    }
}

        /* Base style (default for larger screens) */
        .mobile-btn {
            padding: 0.25rem 2rem; /* same as py-1 px-8 */
            font-size: 1rem;       /* same as text-base */
            
            border-radius: 0.5rem; /* rounded-lg */
            font-weight: 600;      /* font-semibold */
            display: inline-block;
            transition: all 0.3s ease;
        }

        .mobile-btn:hover {
            background-color: #111827; /* gray-900 */
            color: white;
        }

        /* Wrapper styles */
        .category-image-wrapper {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            width: 85%;
            margin: 0 auto;
            overflow: hidden; /* keep image neat inside */
        }

        /* Image styles */
        .category-image {
            width: 90%;
            height: 100%;
            object-fit: cover;
            position: relative;
            bottom: -40px; /* offset like your inline css */
        }

        .category-title{
            font-size: 30px; top:10px; font-weight:800
        }

        .cat-wrapper{
            min-height:420px
        }

        .showroom-img{
            height:380px;
            width:100%;
            object-fit:cover;
        }

       


        /* Mobile adjustments (max width: 640px, Tailwind sm breakpoint) */
        @media (max-width: 640px) {
        .mobile-btn {
            padding: 0.25rem 1rem; /* smaller horizontal padding */
            font-size: 0.575rem;   /* smaller text */
        }
        .mobile-slider {
            min-height:auto;
            background-size: contain;
            background-position: center;
        }
        .mobile-heading {
            font-size: 1.25rem;   /* ~text-xl */
            margin-bottom: 0.75rem;
        }
        }

         /* Responsive tweaks */
        @media (max-width: 1024px) { /* tablets */
        .category-image-wrapper {
            width: 90%;
            height: auto;
        }
        }

        @media (max-width: 640px) { /* mobile */
        .category-image-wrapper {
            width: 100%;
            height: auto;
        }

        .category-title{
            font-size: 15px; top:2px; font-weight:800;
            line-height: 1rem;
        }

        .category-image {
            bottom: -15px; /* smaller offset for mobile */
        }
         .cat-wrapper{
            min-height:auto;
            height:200px !important;
        }
         .showroom-img{
            height:200px;
            
        }
        }

    </style>