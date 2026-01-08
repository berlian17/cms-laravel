@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
    @php
        $topicConfig = match($contactMail->topic) {
            'quotation' => [
                'title' => 'Quotation Request',
                'subtitle' => 'New project quotation inquiry',
                'alert' => 'A quotation request has been received. Please prepare a professional and detailed proposal.',
            ],
            'technical' => [
                'title' => 'Technical Support Request',
                'subtitle' => 'Engineering assistance required',
                'alert' => 'Immediate technical review is required for this request.',
            ],
            'partnership' => [
                'title' => 'Partnership Inquiry',
                'subtitle' => 'Strategic collaboration opportunity',
                'alert' => 'A potential partnership opportunity has been submitted.',
            ],
        };

        $replySubject = rawurlencode(
            'Re: ' . $topicConfig['title'] . ' - ' . $contactMail->subject
        );
    @endphp

    <section class="py-4 px-2 sm:p-0">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-3 sm:p-6 mb-6">

            {{-- HEADER --}}
            <div class="flex items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
                <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center shadow">
                    <i class="fas fa-envelope text-white"></i>
                </div>
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-900">Informasi Pesan Masuk</h2>
                    <p class="text-xs sm:text-sm text-slate-500">
                        Detail pesan yang diterima melalui sistem.
                    </p>
                </div>
            </div>

            {{-- MESSAGE CARD --}}
            <div class="border rounded-xl overflow-hidden">
                <div class="w-full bg-white">
                    
                    {{-- HEADER --}}
                    <div class="bg-[#003A63] p-4 sm:p-7 border-b-4 border-[#CE2919]">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 sm:gap-4">
                            <div class="text-center sm:text-left">
                                <h1 class="m-0 text-white text-lg sm:text-[22px] font-bold">
                                    {{ $topicConfig['title'] }}
                                </h1>
                                <p class="mt-1.5 mb-0 text-white text-xs sm:text-sm">
                                    {{ $topicConfig['subtitle'] }}
                                </p>
                            </div>
                            <div class="hidden sm:flex justify-center">
                                @if(!empty($appSetting->logo2))
                                    <img src="{{ config('app.url') . $appSetting->logo2 }}" alt="REKA" class="h-6 sm:h-[30px] block">
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- CONTENT --}}
                    <div class="p-4 sm:p-8">

                        {{-- ALERT --}}
                        <div class="bg-[#F4F9FF] rounded-xl p-3 sm:p-4 text-xs sm:text-sm leading-relaxed mb-4 sm:mb-6">
                            {{ $topicConfig['alert'] }}
                        </div>

                        {{-- CONTACT INFO --}}
                        <h3 class="mt-0 mb-3 text-sm sm:text-base text-[#003A63] border-b-2 border-[#CE2919] pb-1.5 font-bold">
                            Contact Information
                        </h3>

                        <div class="space-y-2">
                            @foreach([
                                'Name'      => $contactMail->full_name,
                                'Company'   => $contactMail->company_name,
                                'Email'     => $contactMail->email,
                                'Subject'   => $contactMail->subject,
                            ] as $label => $value)
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-0 sm:gap-0 overflow-hidden rounded-lg sm:rounded-none">
                                    <div class="bg-[#F4F9FF] p-2 sm:p-3 font-bold text-xs uppercase text-[#003A63] border-t-4 sm:border-t-0 sm:border-l-4 border-[#003A63] rounded-t-lg sm:rounded-l-lg sm:rounded-t-none">
                                        {{ $label }}
                                    </div>
                                    <div class="bg-[#F4F9FF] p-2 sm:p-3 text-xs sm:text-sm col-span-1 sm:col-span-2 rounded-b-lg sm:rounded-r-lg sm:rounded-b-none">
                                        @if($label == 'Email')
                                            <a href="mailto:{{ $value }}" class="text-[#003A63] hover:underline break-all">
                                                {{ $value }}
                                            </a>
                                        @else
                                            <span class="break-words">{{ $value }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- MESSAGE --}}
                        <h3 class="mt-4 sm:mt-6 mb-3 text-sm sm:text-base text-[#003A63] border-b-2 border-[#CE2919] pb-1.5 font-bold">
                            Message
                        </h3>

                        <div class="bg-[#F4F9FF] rounded-xl p-3 sm:p-4 text-xs sm:text-sm leading-relaxed break-words">
                            {!! nl2br(e($contactMail->message)) !!}
                        </div>

                        {{-- BUTTON --}}
                        <div class="text-center my-6 sm:my-8">
                            <a href="mailto:{{ $contactMail->email }}?subject={{ $replySubject }}"
                               class="inline-block bg-[#003A63] text-white no-underline font-bold text-xs sm:text-sm px-5 sm:px-7 py-2.5 sm:py-3 rounded-xl hover:bg-[#002947] transition-colors">
                                Reply via Email
                            </a>
                        </div>

                        {{-- META --}}
                        <div class="bg-[#f8fafc] border-l-4 border-[#CE2919] p-2.5 sm:p-3.5 text-[10px] sm:text-xs leading-relaxed">
                            <strong>Submitted:</strong> {{ $contactMail->created_at->format('d F Y, H:i') }} WIB<br>
                            <strong>IP Address:</strong> <span class="break-all">{{ $contactMail->ip_address }}</span>
                        </div>
                    </div>

                    {{-- FOOTER --}}
                    <div class="bg-[#1e293b] p-3 sm:p-5 text-center text-white text-[10px] sm:text-xs">
                        This email is generated automatically. Please do not reply to this message.<br>
                        <span class="opacity-70">
                            © {{ date('Y') }} {{ $appSetting->app_name }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
