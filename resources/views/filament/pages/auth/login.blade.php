<x-filament-panels::page.simple>
    <style>
        body {
            background: #0f172a !important;
            background-image:
                radial-gradient(circle at 0% 0%, rgba(59, 130, 246, 0.3) 0%, transparent 80%),
                radial-gradient(circle at 100% 100%, rgba(124, 58, 237, 0.3) 0%, transparent 80%) !important;
            min-height: 100vh;
            margin: 0;
            color: #fff;
        }

        /* Target the main container provided by the simple layout */
        .fi-simple-main {
            /* background-color: rgba(10, 10, 20, 0.75) !important; */ /* Moved to ::after */
            backdrop-filter: blur(24px) !important;
            -webkit-backdrop-filter: blur(24px) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important; /* Visible glass border */
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37) !important; /* Deeper shadow */
            border-radius: 1rem !important;
            padding: 0 !important; /* Remove padding to allow split layout */
            max-width: 900px !important; /* Wider card */
            width: 100%;
            margin: 0 auto;
            position: relative;
            background-clip: padding-box !important;
            overflow: hidden; /* Clip children to border radius */
            /* Subtle surface shine */
            background: linear-gradient(
                135deg,
                rgba(255, 255, 255, 0.05) 0%,
                rgba(255, 255, 255, 0) 100%
            ) !important;
        }

        /* Make the internal wrappers fill the card and handle layout */
        .fi-simple-main > .fi-simple-page {
            height: 100%;
            width: 100%;
        }

        .fi-simple-main > .fi-simple-page > .fi-simple-page-content {
            display: flex;
            flex-direction: row;
            height: 100%;
            width: 100%;
        }

        /* Shining border effect */
        .fi-simple-main::before {
            content: "";
            position: absolute;
            inset: 0; /* Changed from -1px to 0 to avoid clipping */
            z-index: 10;
            pointer-events: none;
            border-radius: inherit;
            padding: 1px; /* Border width */
            background: radial-gradient(
                800px circle at var(--mouse-x, 50%) var(--mouse-y, 50%),
                rgba(255, 255, 255, 0.6),
                transparent 40%
            );
            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .fi-simple-main:hover::before {
            opacity: 1;
        }

        /* Inner background to cover the center of the gradient */
        .fi-simple-main::after {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
            border-radius: inherit;
            /* More transparent background for better glass effect */
            background: linear-gradient(
                135deg,
                rgba(17, 24, 39, 0.4),
                rgba(17, 24, 39, 0.6)
            );
            /* Subtle inner glow */
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.05);
        }

        /* Ensure the wrapper around main is transparent */
        .fi-simple-main-ctn {
            background-color: transparent !important;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Left side (Form) */
        .login-form-wrapper {
            width: 50%;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }


        /* Right side (Illustration) */
        .login-illustration {
            flex: 1;
            margin-left: 0;
            /* border-radius: 1rem; */
            background:
                        url("https://images.unsplash.com/photo-1742679697291-affd3365ebe4?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
        }

        /* Remove abstract geometric shapes */
        .login-illustration::before,
        .login-illustration::after,
        .login-illustration-content::before {
            display: none;
        }

        /* Input fields glassmorphism */
        .fi-input-wrp {
            background-color: rgba(31, 41, 55, 0.5) !important; /* Slightly lighter input background */
            backdrop-filter: blur(10px);
            border-color: rgba(255, 255, 255, 0.1) !important;
        }

        /* Text colors for better contrast on dark background */
        .fi-simple-main h1,
        .fi-simple-main label,
        .fi-simple-main span,
        .fi-simple-main a,
        .fi-simple-main p {
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .fi-input-wrp input {
            color: white !important;
        }

        /* Button styling */
        .fi-btn-primary {
            background: #3b82f6 !important; /* Blue button like reference */
            border: none !important;
            transition: all 0.3s ease;
            position: relative;
            overflow: visible !important; /* Allow shadow to spill out */
            z-index: 10; /* Ensure it's above other elements */
        }

        .fi-btn-primary:hover {
            background: #2563eb !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        /* Custom Heading Style */
        .login-heading {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
            color: white;
            text-align: left;
            letter-spacing: -0.025em;
        }

        .login-subheading {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.6);
            text-align: left;
            margin-bottom: 2.5rem;
        }

        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .fi-simple-main {
                flex-direction: column;
                max-width: 100% !important;
                margin: 1rem;
                width: auto;
            }

            .fi-simple-main > .fi-simple-page > .fi-simple-page-content {
                flex-direction: column;
            }

            .login-illustration {
                display: none;
            }

            .login-form-wrapper {
                width: 100%;
                padding: 2rem;
            }

            .brand-logo {
                position: relative;
                top: auto;
                left: auto;
                margin-bottom: 1.5rem;
                justify-content: center;
            }

            .login-heading, .login-subheading {
                text-align: center;
            }
        }
    </style>

    <div class="login-form-wrapper">
        <h1 class="login-heading">Sign in to IMS</h1>
        <p class="login-subheading">Welcome back! Please enter your details.</p>
        {{ $this->content }}
    </div>

    <div class="login-illustration">
        <div class="login-illustration-content">
            {{-- <h2>Manage Your Incidents</h2>
            <p>Streamline your workflow with our advanced incident management system.</p> --}}
        </div>
    </div>

    <script>
        document.addEventListener('mousemove', (e) => {
            // Card border effect (only)
            const card = document.querySelector('.fi-simple-main');
            if (card) {
                const rect = card.getBoundingClientRect();
                const x2 = e.clientX - rect.left;
                const y2 = e.clientY - rect.top;
                card.style.setProperty('--mouse-x', `${x2}px`);
                card.style.setProperty('--mouse-y', `${y2}px`);
            }
        });
    </script>
</x-filament-panels::page.simple>
