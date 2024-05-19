@extends('admin.layouts.index')

@section('title', 'Trò chuyện')
@section('content')
    <div class="card-body">
            <div class="row">
                <div style="overflow: scroll" class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
                    <div class="p-3">

                        <div class="input-group rounded mb-3">
                            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                            <span class="input-group-text border-0" id="search-addon">
                                                <i class="fas fa-search"></i>
                                        </span>
                        </div>

                        <div data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px;">
                            <ul id="users" class="list-unstyled mb-0">
                            </ul>
                        </div>

                    </div>
                </div>

                <div  class="col-md-6 col-lg-7 col-xl-8">

                    <div id="scroll-list-message" class="pt-3 pe-3" data-mdb-perfect-scrollbar="true" style="position: relative; min-height: 85vh; overflow: scroll">


                        <div  data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px;">
                            <ul id="messages" class="list-unstyled mb-0">
                            </ul>
                        </div>

                    </div>

                    <form class="text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2">
                        <input type="text" id="message" class="form-control" placeholder="Nhập tin nhắn...">
                        <button id="send" class="ms-3 btn btn-primary sm"><i class="fas fa-paper-plane"></i></button>
                    </form>

                </div>
            </div>
    </div>
@endsection

@push('script')
    <script type="module">
        const usersElement = document.getElementById('users')
        const messagesElement = document.getElementById('messages')
        const currentUser = @json(auth()->user());
        const listMessage = [];
        const scrollMessage = document.getElementById('scroll-list-message')

        Echo.join('chat')
            .here((users) => {
                users.forEach((user, index) => {
                    const element = `
                                <li id="${user.id}" class="p-2 border-bottom">
                                    <a href="#" class="d-flex justify-content-between  align-items-center">
                                        <div class="d-flex flex-row align-items-center">
                                            <div>
                                                <img src="${'{{ asset('uploads/') }}' + '/' + user.images[0].url}" style="border-radius:50%" alt="avatar" class="d-flex align-self-center me-3" width="60">
                                                <span class="badge bg-warning badge-dot"></span>
                                            </div>
                                            <div class="pt-1 ml-2">
                                                <p class="fw-bold mb-0">${user.name}</p>
                                            </div>
                                        </div>
                                        <div class="pt-1">
                                            <p style="color: #31a24c; font-weight: 600" class="small mb-1">Online</p>
                                        </div>
                                    </a>
                                </li>
                    `;
                    usersElement.insertAdjacentHTML('beforeend', element);
                })

                window.axios.get('/chats/message')
                    .then((response) => {
                        const messages = response.data
                        listMessage.push(...messages);
                        listMessage.forEach((message) => {
                            const time = new Date(message.created_at);
                            const timeFormat = time.getHours() + ':' + time.getMinutes() + '  -  '
                                + time.getDate()
                                + '/' + time.getMonth() + '/' + time.getFullYear() ;
                            if(message.user.id === currentUser.id) {
                                const element = `
                                <li class="d-flex flex-row justify-content-end">
                                    <div>
                                        <p style="border-radius:4px " class="small p-2 me-3 mb-1 text-white rounded-3 mr-2 bg-primary">${message.message}</p>
                                        <p class="small me-3 mb-3 rounded-3 text-muted float-right"> ${timeFormat} | ${message.user.name}</p>
                                    </div>
                                     <img src="${'{{ asset('uploads/') }}' + '/' + message.user.images[0].url}" alt="avatar 1" style="border-radius: 50%;width: 45px; height: 100%;">
                                </li>

                                `;
                                messagesElement.insertAdjacentHTML('beforeend', element)
                            } else {
                                const element = `
                                <li class="d-flex flex-row justify-content-start">
                                     <img src="${'{{ asset('uploads/') }}' + '/' + message.user.images[0].url}" alt="avatar 1" style="border-radius: 50%;width: 45px; height: 100%;">
                                    <div>
                                        <p class="small p-2 ms-3 mb-1 rounded-3 ml-2" style="border-radius:4px;background-color: #ddd;">
                                            ${message.message}
                                        </p>
                                        <p class="small ms-3 mb-3 rounded-3 text-muted float-end">${message.user.name} | ${timeFormat}</p>
                                    </div>
                                </li>

                                `;
                                messagesElement.insertAdjacentHTML('beforeend', element)
                            }
                            scrollMessage.scrollTop = scrollMessage.scrollHeight;
                        })
                    })
            })
            .joining((user) => {
                const element = `
                                <li id="${user.id}" class="p-2 border-bottom">
                                    <a href="#" class="d-flex justify-content-between  align-items-center">
                                        <div class="d-flex flex-row align-items-center">
                                            <div>
                                                <img src="${'{{ asset('uploads/') }}' + '/' + user.images[0].url}" alt="avatar" class="d-flex align-self-center me-3" style="border-radius:50%" width="60">
                                                <span class="badge bg-warning badge-dot"></span>
                                            </div>
                                            <div class="pt-1 ml-2">
                                                <p class="fw-bold mb-0">${user.name}</p>
                                            </div>
                                        </div>
                                        <div class="pt-1">
                                            <p style="color: #31a24c; font-weight: 600" class="small mb-1">Online</p>
                                        </div>
                                    </a>
                                </li>
                    `;
                usersElement.insertAdjacentHTML('beforeend', element);
                showNotify(user.name+' đã tham gia trò chuyện', 'success');
            })
            .leaving((user) => {
                const element = document.getElementById(user.id)
                element.parentNode.removeChild(element)
                showNotify(user.name+' đã rời khỏi trò chuyện', 'danger');

            })
            .listen('MessageSend', (e) => {
                const time = new Date();
                const timeFormat = time.getHours() + ':' + time.getMinutes() + ', Hôm nay '
                if(e.user.name === currentUser.name) {
                    const element = `
                                <li class="d-flex flex-row justify-content-end">
                                    <div>
                                        <p style="border-radius:4px " class="small p-2 me-3 mb-1 text-white mr-2 rounded-3 bg-primary">${e.message}</p>
                                        <p class="small me-3 mb-3 rounded-3 text-muted">${timeFormat}</p>
                                    </div>
                                    <img src="${'{{ asset('uploads/') }}' + '/' + e.user.images[0].url}" alt="avatar 1" style="width: 45px; height: 100%;border-radius:50%">
                                </li>

                 `;
                    messagesElement.insertAdjacentHTML('beforeend', element)
                } else {
                    const element = `
                                <li class="d-flex flex-row justify-content-start">
                                    <img src="${'{{ asset('uploads/') }}' + '/' + e.user.images[0].url}" alt="avatar 1" style="width: 45px; height: 100%;border-radius:50%">
                                    <div>
                                        <p class="small p-2 ms-3 mb-1 ml-2 rounded-3" style="border-radius:4px;background-color: #ddd;">
                                            ${e.message}
                                        </p>
                                        <p class="small ms-3 mb-3 rounded-3 text-muted float-end">${timeFormat}</p>
                                    </div>
                                </li>

                 `;
                    messagesElement.insertAdjacentHTML('beforeend', element)
                }

                scrollMessage.scrollTop = scrollMessage.scrollHeight;
            })
    </script>

    <script type="module">
        const messageElement = document.getElementById('message')
        const sendElement = document.getElementById('send')

        sendElement.addEventListener('click', (e) => {
            e.preventDefault();
            window.axios.post('/chats/message', {
                message: messageElement.value
            })

            messageElement.value = ""
        })
    </script>
    <script>
        function showNotify(message, type) {
            const notiElement = document.getElementById('notification');
            notiElement.innerHTML = `
                <span>Thông báo: ${message}</span>
             `

            notiElement.classList.remove('invisible')
            notiElement.classList.remove('alert-success')
            notiElement.classList.remove('alert-danger')
            notiElement.classList.remove('show')
            notiElement.classList.add('alert-'+type)
            notiElement.classList.add('show')

            setTimeout(() => {
                notiElement.classList.remove('show');
                notiElement.classList.add('invisible');
            }, 5000); // 5 giây
        }
    </script>
@endpush
