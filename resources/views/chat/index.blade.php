<x-app-layout>
    <x-slot name="header">
        Ruang Obrolan
    </x-slot>

    <div x-data="{ isMobileChatOpen: false }" class="h-[calc(100vh-140px)] flex bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden relative">
        
        <!-- Sidebar: User List & Channels -->
        <div :class="isMobileChatOpen ? 'hidden md:flex' : 'flex'" 
             class="w-full md:w-1/4 border-r border-gray-200 flex-col bg-gray-50 flex-shrink-0">
            <div class="p-4 border-b border-gray-200 bg-white">
                <h3 class="font-bold text-gray-800">Obrolan</h3>
            </div>
            
            <div class="overflow-y-auto flex-1 p-2 space-y-1">
                <!-- Global Channel -->
                <button @click="openChat('global', 'Ruang Utama (Semua Anggota)'); isMobileChatOpen = true" id="chat-btn-global" class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-pink-50 transition-colors text-left group active-chat bg-pink-50">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center text-white shadow-sm flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div class="overflow-hidden flex-1">
                        <h4 class="font-semibold text-gray-800 truncate group-hover:text-pink-700">Ruang Utama</h4>
                        <p class="text-xs text-gray-500 truncate">Semua Admin & Kakak Asuh</p>
                    </div>
                    <!-- Unread Badge -->
                    <span id="badge-global" class="hidden flex h-5 min-w-[20px] items-center justify-center rounded-full bg-red-500 px-1.5 text-[10px] font-bold text-white"></span>
                </button>

                <div class="my-2 border-t border-gray-200"></div>
                <h4 class="px-3 text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 mt-4">Japri Kontak</h4>

                <!-- Private Chats List -->
                @foreach($users as $user)
                    <button @click="openChat({{ $user->id }}, '{{ $user->name }}'); isMobileChatOpen = true" id="chat-btn-{{ $user->id }}" class="w-full flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 transition-colors text-left group">
                        <div class="flex items-center gap-3 overflow-hidden">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 shadow-sm flex-shrink-0 font-bold border border-emerald-200">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="overflow-hidden">
                                <h4 class="font-medium text-gray-800 text-sm truncate group-hover:text-gray-900">{{ $user->name }}</h4>
                                <p class="text-[11px] text-gray-500 capitalize">{{ str_replace('_', ' ', $user->role) }}</p>
                            </div>
                        </div>
                        <!-- Unread Badge -->
                        <span id="badge-{{ $user->id }}" class="hidden flex h-5 min-w-[20px] items-center justify-center rounded-full bg-red-500 px-1.5 text-[10px] font-bold text-white"></span>
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Chat Area -->
        <div :class="isMobileChatOpen ? 'flex' : 'hidden md:flex'"
             class="flex-1 flex-col bg-[#f0f2f5] relative w-full">
            
            <!-- Chat Header -->
            <div class="h-16 border-b border-gray-200 bg-white flex items-center justify-between px-4 sm:px-6 shadow-sm z-10">
                <div class="flex items-center gap-2 sm:gap-3 overflow-hidden">
                    {{-- Mobile Back Button --}}
                    <button @click="isMobileChatOpen = false" class="md:hidden p-2 -ml-2 text-gray-500 hover:text-pink-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>

                    <div id="active-chat-avatar" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center text-white shadow-sm flex-shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div class="overflow-hidden">
                        <h3 id="active-chat-name" class="font-bold text-gray-800 text-sm sm:text-base truncate">Ruang Utama (Semua Anggota)</h3>
                        <p id="active-chat-status" class="text-[10px] sm:text-xs text-green-500 flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Online</p>
                    </div>
                </div>
                
                <!-- Polling Button -->
                <div>
                    <button onclick="openPollModal()" class="flex items-center gap-1 sm:gap-2 px-3 sm:px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-colors text-xs sm:text-sm font-semibold shadow-sm border border-indigo-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <span class="hidden xs:inline">Poling</span>
                    </button>
                </div>
            </div>

            <!-- Messages Container -->
            <div id="messages-container" class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-4">
                <!-- Messages will be loaded here via JS -->
                 <div class="flex justify-center">
                    <span class="bg-gray-200 text-gray-600 text-xs px-3 py-1 rounded-full shadow-sm">Memuat pesan...</span>
                </div>
            </div>

            <!-- Input Area -->
            <div class="p-3 sm:p-4 bg-white border-t border-gray-200">
                <form id="chat-form" class="flex gap-2 items-end">
                    <div class="flex-1 bg-gray-100 rounded-2xl flex items-center px-4 py-2 border border-gray-200 focus-within:border-pink-300 focus-within:ring-1 focus-within:ring-pink-300 transition-all shadow-inner">
                        <textarea id="message-input" rows="1" class="w-full bg-transparent border-0 focus:ring-0 resize-none max-h-32 text-sm text-gray-800 placeholder-gray-400 py-1.5" placeholder="Ketik pesan..." required></textarea>
                    </div>
                    <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white rounded-full w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center shadow-md transition-transform transform hover:scale-105 flex-shrink-0">
                        <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Polling Modal -->
    <div id="poll-modal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg overflow-hidden flex flex-col h-[80vh]">
            <div class="p-4 border-b flex justify-between items-center bg-gray-50">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Area Poling
                </h3>
                <button onclick="closePollModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto p-4 bg-gray-50" id="poll-list-container">
                <!-- Polls will be injected here -->
                <div class="flex justify-center p-4"><span class="text-gray-500 text-sm">Memuat poling...</span></div>
            </div>

            @if(Auth::user()->role === 'kakak_asuh')
            <!-- Create Poll Section (Kakak Asuh Only) -->
            <div class="p-4 border-t bg-white">
                <button onclick="toggleCreatePollForm()" class="w-full py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">
                    + Buat Poling Baru
                </button>
                
                <form id="create-poll-form" class="mt-4 hidden space-y-3">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Pertanyaan Poling</label>
                        <input type="text" id="poll-question" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Ketik pertanyaan...">
                    </div>
                    <div id="poll-options-container" class="space-y-2">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Pilihan 1</label>
                            <input type="text" name="poll_option[]" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Pilihan 1">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Pilihan 2</label>
                            <input type="text" name="poll_option[]" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Pilihan 2">
                        </div>
                    </div>
                    <button type="button" onclick="addPollOption()" class="text-xs text-indigo-600 font-bold hover:underline">+ Tambah Pilihan</button>
                    
                    <div class="flex gap-2 pt-2">
                        <button type="button" onclick="toggleCreatePollForm()" class="flex-1 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-semibold transition">Batal</button>
                        <button type="submit" class="flex-1 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold transition">Simpan Poling</button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>

    <!-- JavaScript block for polling and logic -->
    <!-- JavaScript block for polling and logic -->
    <script>
        let currentChatId = 'global'; // 'global' or user ID
        const currentUserId = {{ Auth::id() }};
        const messagesContainer = document.getElementById('messages-container');
        const messageInput = document.getElementById('message-input');
        const chatForm = document.getElementById('chat-form');
        
        // Auto resize textarea
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
            if(this.value === '') this.style.height = 'auto'; // reset
        });

        // Submit on Enter (prevent default new line unless Shift is pressed)
        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                if(this.value.trim() !== '') {
                    chatForm.dispatchEvent(new Event('submit'));
                }
            }
        });

        function openChat(id, name) {
            currentChatId = id;
            
            // Update UI Sidebar
            document.querySelectorAll('[id^="chat-btn-"]').forEach(btn => {
                btn.classList.remove('bg-pink-50');
            });
            document.getElementById('chat-btn-' + id).classList.add('bg-pink-50');

            // Update Header
            document.getElementById('active-chat-name').innerText = name;
            const avatar = document.getElementById('active-chat-avatar');
            if(id === 'global') {
                avatar.className = "w-10 h-10 rounded-full bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center text-white shadow-sm";
                avatar.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>';
            } else {
                avatar.className = "w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white shadow-sm font-bold border border-emerald-600";
                avatar.innerHTML = name.substring(0, 1).toUpperCase();
            }

            // Fetch initial messages immediately
            fetchMessages(true);
        }

        function formatTime(dateString) {
            const date = new Date(dateString);
            return date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        }

        function escapeHTML(str) {
            return str.replace(/[&<>'"]/g, 
                tag => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    "'": '&#39;',
                    '"': '&quot;'
                }[tag])
            ).replace(/\n/g, '<br>');
        }

        function buildMessageHTML(msg) {
            const isMine = msg.pengirim_id === currentUserId;
            
            if(isMine) {
                return `
                <div class="flex justify-end mb-4">
                    <div class="flex flex-col items-end max-w-[85%] md:max-w-[70%]">
                        <div class="bg-pink-600 text-white rounded-2xl rounded-tr-sm px-4 py-2 shadow-sm">
                            <p class="text-[14px] sm:text-[15px] leading-relaxed break-words">${escapeHTML(msg.isi_pesan)}</p>
                        </div>
                        <span class="text-[10px] text-gray-400 mt-1">${formatTime(msg.created_at)}</span>
                    </div>
                </div>`;
            } else {
                return `
                <div class="flex justify-start mb-4">
                    <div class="flex flex-col items-start max-w-[85%] md:max-w-[70%]">
                        <span class="text-[10px] sm:text-xs font-semibold text-gray-500 ml-1 mb-1">${msg.pengirim.name}</span>
                        <div class="bg-white text-gray-800 rounded-2xl rounded-tl-sm px-4 py-2 shadow-sm border border-gray-100">
                            <p class="text-[14px] sm:text-[15px] leading-relaxed break-words">${escapeHTML(msg.isi_pesan)}</p>
                        </div>
                        <span class="text-[10px] text-gray-400 mt-1 ml-1">${formatTime(msg.created_at)}</span>
                    </div>
                </div>`;
            }
        }

        async function fetchMessages(scrollToBottom = false) {
            const isAtBottom = messagesContainer.scrollHeight - messagesContainer.scrollTop <= messagesContainer.clientHeight + 50;
            
            try {
                const url = currentChatId === 'global' ? '/chat/global' : `/chat/private/${currentChatId}`;
                const response = await fetch(url);
                const messages = await response.json();
                
                let html = '';
                if(messages.length === 0) {
                    html = `
                    <div class="h-full flex flex-col items-center justify-center text-gray-400 opacity-60">
                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        <p>Belum ada pesan. Jadilah yang pertama menyapa!</p>
                    </div>`;
                } else {
                    html = messages.map(msg => buildMessageHTML(msg)).join('');
                }
                
                messagesContainer.innerHTML = html;

                if (scrollToBottom || isAtBottom) {
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }
            } catch (error) {
                console.error("Error fetching messages:", error);
                messagesContainer.innerHTML = `<div class="p-4 bg-red-100 text-red-700 rounded-lg">Error memuat pesan: ${error.message}. Coba refresh halaman.</div>`;
            }
        }

        // Unread Badges Logic
        async function fetchUnreadBadges() {
            try {
                const response = await fetch('{{ route("chat.unread") }}');
                const data = await response.json();
                
                // Process Global Badge
                const globalBadge = document.getElementById('badge-global');
                if (data.global > 0 && currentChatId !== 'global') {
                    globalBadge.classList.remove('hidden');
                    globalBadge.innerText = data.global > 99 ? '99+' : data.global;
                } else {
                    globalBadge.classList.add('hidden');
                }

                // Process Private Badges
                for (const userId in data.private) {
                    const count = data.private[userId];
                    const badge = document.getElementById('badge-' + userId);
                    if (badge) {
                        if (count > 0 && currentChatId != userId) {
                            badge.classList.remove('hidden');
                            badge.innerText = count > 99 ? '99+' : count;
                        } else {
                            badge.classList.add('hidden');
                        }
                    }
                }
            } catch (error) {
                console.error("Error fetching unread badges:", error);
            }
        }

        chatForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const text = messageInput.value.trim();
            if(!text) return;

            messageInput.value = '';
            messageInput.style.height = 'auto'; // reset height

            try {
                const response = await fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        isi_pesan: text,
                        penerima_id: currentChatId === 'global' ? null : currentChatId
                    })
                });
                
                if (response.ok) {
                    fetchMessages(true); // force scroll to bottom on new message send
                }
            } catch (error) {
                console.error("Failed to send message", error);
                alert("Gagal mengirim pesan. Coba lagi.");
            }
        });

        // Modal & Polling Logic
        function openPollModal() {
            document.getElementById('poll-modal').classList.remove('hidden');
            fetchPolls();
        }

        function closePollModal() {
            document.getElementById('poll-modal').classList.add('hidden');
        }

        function toggleCreatePollForm() {
            const form = document.getElementById('create-poll-form');
            if (form) {
                form.classList.toggle('hidden');
            }
        }

        function addPollOption() {
            const container = document.getElementById('poll-options-container');
            const count = container.children.length + 1;
            const div = document.createElement('div');
            div.innerHTML = `
                <label class="block text-xs font-bold text-gray-700 mb-1">Pilihan ${count}</label>
                <div class="flex gap-2">
                    <input type="text" name="poll_option[]" required class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Pilihan ${count}">
                    <button type="button" onclick="this.parentElement.parentElement.remove()" class="px-2 text-red-500 hover:text-red-700 font-bold">&times;</button>
                </div>
            `;
            container.appendChild(div);
        }

        async function fetchPolls() {
            try {
                const response = await fetch('{{ route("chat.polls") }}');
                const polls = await response.json();
                
                const container = document.getElementById('poll-list-container');
                if(polls.length === 0) {
                    container.innerHTML = '<div class="text-center p-6 text-gray-500">Belum ada poling.</div>';
                    return;
                }

                let html = '';
                polls.forEach(poll => {
                    // Check if current user voted
                    const userVote = poll.votes.find(v => v.user_id === currentUserId);
                    const totalVotes = poll.votes.length;

                    html += `
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-4">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="font-bold text-gray-800 text-sm">${escapeHTML(poll.question)}</h4>
                            <span class="text-[10px] text-gray-400 bg-gray-100 px-2 py-1 rounded">Oleh: ${escapeHTML(poll.creator.name)}</span>
                        </div>
                        <div class="space-y-2">`;
                    
                    poll.options.forEach(opt => {
                        const optVotes = opt.votes ? opt.votes.length : 0;
                        const percentage = totalVotes > 0 ? Math.round((optVotes / totalVotes) * 100) : 0;
                        const isSelected = userVote && userVote.poll_option_id === opt.id;

                        if (userVote) {
                            // Show Results
                            html += `
                            <div class="relative w-full bg-gray-100 rounded-lg overflow-hidden border ${isSelected ? 'border-indigo-500' : 'border-transparent'}">
                                <div class="absolute top-0 left-0 h-full bg-indigo-100" style="width: ${percentage}%"></div>
                                <div class="relative p-2 flex justify-between items-center text-sm z-10">
                                    <span class="font-medium ${isSelected ? 'text-indigo-700' : 'text-gray-700'}">
                                        ${isSelected ? '<svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg>' : ''}
                                        ${escapeHTML(opt.option_text)}
                                    </span>
                                    <span class="text-xs font-bold text-indigo-600">${percentage}% (${optVotes})</span>
                                </div>
                            </div>`;
                        } else {
                            // Show Voting Buttons
                            html += `
                            <button onclick="votePoll(${poll.id}, ${opt.id})" class="w-full text-left p-2 rounded-lg border border-gray-200 hover:border-indigo-400 hover:bg-indigo-50 transition text-sm text-gray-700 font-medium">
                                ${escapeHTML(opt.option_text)}
                            </button>`;
                        }
                    });

                    html += `
                        </div>
                        <div class="mt-3 text-xs text-gray-400 text-right">${totalVotes} suara • ${formatTime(poll.created_at)}</div>
                    </div>`;
                });

                container.innerHTML = html;
            } catch (error) {
                console.error("Error fetching polls:", error);
                document.getElementById('poll-list-container').innerHTML = '<div class="text-red-500 p-4">Error memuat poling.</div>';
            }
        }

        async function votePoll(pollId, optionId) {
            try {
                const response = await fetch(`/chat/polls/${pollId}/vote`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ option_id: optionId })
                });

                if (response.ok) {
                    fetchPolls(); // Refresh poll list
                } else {
                    const data = await response.json();
                    alert(data.message || 'Gagal memberikan suara');
                }
            } catch (error) {
                console.error("Error voting:", error);
                alert("Terjadi kesalahan.");
            }
        }

        const createPollForm = document.getElementById('create-poll-form');
        if (createPollForm) {
            createPollForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const question = document.getElementById('poll-question').value;
                const optionInputs = document.getElementsByName('poll_option[]');
                const options = Array.from(optionInputs).map(i => i.value).filter(v => v.trim() !== '');

                if(options.length < 2) {
                    alert('Minimal 2 pilihan diperlukan.');
                    return;
                }

                try {
                    const response = await fetch('{{ route("chat.polls.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ question, options })
                    });

                    if (response.ok) {
                        createPollForm.reset();
                        toggleCreatePollForm();
                        fetchPolls();
                    } else {
                        alert('Gagal membuat poling.');
                    }
                } catch (error) {
                    console.error("Error creating poll:", error);
                    alert("Terjadi kesalahan.");
                }
            });
        }

        // Initialize Global Chat and Polling
        openChat('global', 'Ruang Utama (Semua Anggota)');
        
        // Poll every 3 seconds for messages
        setInterval(() => {
            fetchMessages(false);
            fetchUnreadBadges();
        }, 3000);
        
        // Initial fetch for badges
        fetchUnreadBadges();
    </script>

</x-app-layout>
