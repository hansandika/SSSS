<x-app-layout title='Frequently Asked Questions'>
    <h1 class="mb-4 text-3xl font-semibold text-black-50">Frequent Asked Question</h1>
    <h4 class="mb-8 text-sm text-black-50">Here as some questions that frequently asked. These Information were
        provided
        by GLC Member which can be trusted.</h4>
    <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-black-700">
        @foreach ($listFaq as $idx => $faq)
            <x-faq-item :question="$faq['question']" :answer="$faq['answer']" :idx="$idx" />
        @endforeach
    </div>
</x-app-layout>
