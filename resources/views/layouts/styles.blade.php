<style>
        .carousel-slide {
        opacity: 0;
        transform: translateX(100%);
        transition: all 1s ease-in-out;
        position: absolute;
        inset: 0; /* replaces top/left/width/height */
        }

        .carousel-slide.active {
        opacity: 1;
        transform: translateX(0);
        z-index: 10;
        }

        .carousel-container {
        position: relative;
        width: 100%;
        height: 100%;
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

        /* Mobile adjustments (max width: 640px, Tailwind sm breakpoint) */
        @media (max-width: 640px) {
        .mobile-btn {
            padding: 0.25rem 1rem; /* smaller horizontal padding */
            font-size: 0.575rem;   /* smaller text */
        }
        .mobile-heading {
            font-size: 1.25rem;   /* ~text-xl */
            margin-bottom: 0.75rem;
        }
        }

    </style>