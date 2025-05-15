<!DOCTYPE html>
<html lang="{{ env('APP_LOCALE') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ env('APP_NAME') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@400;500;700&family=Cinzel+Decorative:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&family=Sora:wght@100..800&display=swap" rel="stylesheet">

    <style>
        html, body {
          margin: 0;
          padding: 0;
        }
    </style>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'great-vibes': ['"Great Vibes"', 'cursive'],
                        'playfair': ['"Playfair Display"', 'serif'],
                        'cinzel': ['"Cinzel Decorative"', 'serif'],
                        'sora': ['"sora"', 'sans-serif'],
                        'oleo': ['"oleo"', 'sans-serif'],
                    },
                    colors: {
                        gold: '#D4AF37',
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-black min-h-screen flex items-center justify-center">
    <div id="invitation" class="relative w-full max-w-[794px] aspect-[1/1.414] overflow-hidden m-0 p-0">
        <!-- Background with overlay -->
        <div class="absolute inset-0 bg-cover bg-center w-full h-full" style="background-image: url('{{ asset('images/template.png') }}')">
        </div>

        <!-- Content -->
        <div class="relative z-10 h-full p-12 sm:p-24 md:p-40 flex flex-col items-center justify-between text-center text-white">
            <!-- Header -->
            <div class="w-full mt-5 sm:mt-12 lg:mt-16">
                <div class="flex items-center justify-center mb-3 md:mb-8">
                    <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gold to-transparent"></div>
                    <span class="mx-1 text-gold">✦</span>
                    <h2 class="font-great-vibes text-xl sm:text-2xl md:text-4xl font-extrabold text-gold px-4 tracking-wider">INVITATION</h2>
                    <span class="mx-1 text-gold">✦</span>
                    <div class="flex-1 h-px bg-gradient-to-r from-transparent via-gold to-transparent"></div>
                </div>

                <div class="mt-3 md:mt-8">
                    <p class="font-playfair text-sm sm:text-xl md:text-xl mb-2 sm:mb-3">Cher(e)</p>
                    <p class="font-great-vibes text-3xl md:text-5xl text-gold mb-3 sm:mb-6 font-bold">{{ $invitation->user->first_name . ' ' . $invitation->user->name }}</p>
                    <p class="font-playfair text-sm sm:text-xl md:text-xl">Vous êtes cordialement invité(e) à</p>
                </div>
            </div>

            <div class="sm:my-4">
                <h1 class="font-sora font-extrabold text-3xl sm:text-4xl md:text-5xl text-gold tracking-wide leading-tight">
                    {{ $invitation->event->name }}
                </h1>
            </div>

            <!-- Event Title -->
            <div class="sm:my-4">


                <div class="grid grid-cols-3 max-w-md mx-3 gap-1 items-center justify-center border border-y p-2 border-dashed border-gray-700">
                    <div class="font-playfair text-sm sm:text-lg md:text-xl tracking-widest border border-r border-dashed border-gray-700">{{ ucfirst(\Carbon\Carbon::parse($invitation->event->starts_at)->translatedFormat('l')) }}</div>
                    <div class="font-cinzel text-3xl sm:text-4xl md:text-5xl text-gold font-bold">{{ ucfirst(\Carbon\Carbon::parse($invitation->event->starts_at)->translatedFormat('d')) }}</div>
                    <div class="font-playfair text-sm sm:text-lg md:text-xl tracking-widest border border-l border-dashed border-gray-700">{{ ucfirst(\Carbon\Carbon::parse($invitation->event->starts_at)->translatedFormat('F')) }}</div>
                </div>
            </div>

            <!-- QR Code -->
            <div class="flex flex-col items-center">
                <div class="relative p-2 md:p-4 bg-white/10 backdrop-blur-sm rounded-md border border-gold/30">
                    <!-- Affichage du QR Code -->
                    <img src="{{ $qrCode ?? '' }}" alt="QR Code" class="w-32 h-32 sm:w-40 sm:h-40 md:w-48 md:h-48">
                </div>
                <p class="font-playfair text-sm md:text-base mt-4 mx-12 bg-gray-950/60 rounded-lg">Cette carte d'invitation est importante pour l'entrée au lieu de faite. Conserver le soigneusement.</p>
            </div>
        </div>
    </div>
    <div class="absolute top-4 right-4 z-20">
        <button onclick="generatePDF()" class="px-4 py-2 bg-gold text-black font-semibold rounded shadow hover:bg-yellow-400 transition">
            Télécharger
        </button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        // Generate decorative QR code pattern
        const qrGrid = document.getElementById('qrGrid');
        for (let i = 0; i < 36; i++) {
            const cell = document.createElement('div');
            cell.className = `rounded-sm ${Math.random() > 0.5 ? 'bg-gold' : 'bg-white'}`;
            qrGrid.appendChild(cell);
        }

        function generatePDF() {
            const element = document.getElementById('invitation');
            const opt = {
                margin:       0,
                filename:     "invitation-{{ $invitation->user->personal_code }}.pdf",
                image:        { type: 'png', quality: 1 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'px', format: [794, 1123], orientation: 'portrait' }
                };
            html2pdf().set(opt).from(element).save();
        }
    </script>
</body>
</html>