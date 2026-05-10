<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Sahabat Laut</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#084c61] min-h-screen">

    <div class="max-w-4xl mx-auto py-12 px-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-white">Frequently Asked Questions</h1>
            <p class="text-blue-200 mt-2">Semua yang perlu kamu tahu tentang Sahabat Laut</p>
        </div>

        <div class="space-y-4">
            @foreach($faqs as $faq)
            <div class="bg-white border border-blue-100 rounded-2xl shadow-sm overflow-hidden">
                <button onclick="toggleFaq({{ $faq->id }})" class="w-full flex justify-between items-center p-5 text-left hover:bg-blue-50 transition-all">
                    <span class="font-bold text-gray-800">{{ $faq->question }}</span>
                    <svg id="icon-{{ $faq->id }}" class="w-5 h-5 text-[#084c61] transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="answer-{{ $faq->id }}" class="hidden p-5 bg-blue-50 text-gray-600 border-t border-blue-100 italic">
                    {{ $faq->answer }}
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <a href="/masyarakat/dashboard" class="text-white hover:underline">Kembali ke Dashboard</a>
        </div>
    </div>

    <script>
        function toggleFaq(id) {
            const answer = document.getElementById(`answer-${id}`);
            const icon = document.getElementById(`icon-${id}`);
            answer.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }
    </script>
</body>
</html>