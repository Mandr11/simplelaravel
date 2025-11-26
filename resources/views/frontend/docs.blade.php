@extends('layouts.frontend')

@section('page', 'docs')

@section('content')
    <div class="max-w-6xl mx-auto py-8">
        <h1 class="text-4xl font-bold text-center mb-12 text-indigo-700">Our Amazing Team</h1>
        

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            
            {{-- Member 1: Charistheo Lasso’ Jireh --}}
            <div class="bg-white rounded-lg shadow-xl p-6 text-center transform hover:scale-105 transition-transform duration-300">
                <div class="w-32 h-32 rounded-full overflow-hidden mx-auto mb-4 border-4 border-indigo-200">
                    <img src="https://image.pollinations.ai/prompt/handsome%20man%20profile%20picture,%20smiling,%20short%20hair,%20casual%20outfit,%20natural%20lighting,%20high%20resolution,%20studio%20background" alt="Charistheo Lasso’ Jireh" class="w-full h-full object-cover">
                </div>
                <h2 class="text-xl font-semibold text-slate-800">Charistheo Lasso’ Jireh</h2>
                <p class="text-indigo-600 font-medium">H1101221026</p>
                <p class="text-slate-500 mt-2 text-sm">Passionate about web development and creating engaging user experiences.</p>
            </div>

            {{-- Member 2: Dhani Raynaldi --}}
            <div class="bg-white rounded-lg shadow-xl p-6 text-center transform hover:scale-105 transition-transform duration-300">
                <div class="w-32 h-32 rounded-full overflow-hidden mx-auto mb-4 border-4 border-indigo-200">
                    <img src="https://image.pollinations.ai/prompt/young%20man%20profile%20picture,%20friendly%20smile,%20modern%20hairstyle,%20developer%20vibe,%20soft%20lighting,%20professional%20look" alt="Dhani Raynaldi" class="w-full h-full object-cover">
                </div>
                <h2 class="text-xl font-semibold text-slate-800">Dhani Raynaldi</h2>
                <p class="text-indigo-600 font-medium">H1101221028</p>
                <p class="text-slate-500 mt-2 text-sm">Specializing in backend logic and database management, ensuring robust applications.</p>
            </div>

            {{-- Member 3: Khalid Ibnu Natsir --}}
            <div class="bg-white rounded-lg shadow-xl p-6 text-center transform hover:scale-105 transition-transform duration-300">
                <div class="w-32 h-32 rounded-full overflow-hidden mx-auto mb-4 border-4 border-indigo-200">
                    <img src="https://image.pollinations.ai/prompt/male%20student%20profile%20photo,%20energetic%20look,%20dark%20hair,%20wearing%20glasses,%20bright%20background" alt="Khalid Ibnu Natsir" class="w-full h-full object-cover">
                </div>
                <h2 class="text-xl font-semibold text-slate-800">Khalid Ibnu Natsir</h2>
                <p class="text-indigo-600 font-medium">H1101221046</p>
                <p class="text-slate-500 mt-2 text-sm">Focusing on system architecture and ensuring smooth integration of components.</p>
            </div>

            {{-- Member 4: Mandri --}}
            <div class="bg-white rounded-lg shadow-xl p-6 text-center transform hover:scale-105 transition-transform duration-300">
                <div class="w-32 h-32 rounded-full overflow-hidden mx-auto mb-4 border-4 border-indigo-200">
                    <img src="https://image.pollinations.ai/prompt/young%20male%20programmer%20profile,%20confident%20pose,%20beard%20(optional),%20creative%20workspace%20background" alt="Mandri" class="w-full h-full object-cover">
                </div>
                <h2 class="text-xl font-semibold text-slate-800">Mandri</h2>
                <p class="text-indigo-600 font-medium">H1101221052</p>
                <p class="text-slate-500 mt-2 text-sm">Driving innovation and new feature development for cutting-edge solutions.</p>
            </div>

            {{-- Member 5: Atala Keanu Djibran --}}
            <div class="bg-white rounded-lg shadow-xl p-6 text-center transform hover:scale-105 transition-transform duration-300">
                <div class="w-32 h-32 rounded-full overflow-hidden mx-auto mb-4 border-4 border-indigo-200">
                    <img src="https://image.pollinations.ai/prompt/student%20profile%20picture,%20smart%20casual,%20short%20dark%20hair,%20friendly%20expression,%20university%20setting" alt="Atala Keanu Djibran" class="w-full h-full object-cover">
                </div>
                <h2 class="text-xl font-semibold text-slate-800">Atala Keanu Djibran</h2>
                <p class="text-indigo-600 font-medium">H1101221054</p>
                <p class="text-slate-500 mt-2 text-sm">Ensuring quality assurance and smooth deployment of all applications.</p>
            </div>
            
        </div>

        <div class="text-center mt-12">
            <a href="/" class="btn-primary inline-block bg-indigo-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-indigo-700 transition-colors text-lg">
                ← Back to Home
            </a>
        </div>
    </div>
@endsection