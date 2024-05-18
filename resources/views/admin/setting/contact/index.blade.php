@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.setting.index') }}">Setting</a>
    <a href="{{ route('admin.setting.contact.index') }}">Contact</a>
@endsection
@section('active', 'setting')
@section('content')
    <div class="shadow mt-2 p-3 bg-white rounded">
        <div class="row mb-2">
            <div class="col-md-4 mb-2">
                <label for="cname">Name</label>
                @if ($contact)
                    <input type="text" name="cname" id="cname" class="form-control" value="{{ $contact->name }}">
                @else
                    <input type="text" name="cname" id="cname" class="form-control">
                @endif
            </div>
            <div class="col-md-4 mb-2">
                <label for="address">address</label>
                @if ($contact)
                    <input type="text" name="address" id="address" class="form-control"
                        value="{{ $contact->address }}">
                @else
                    <input type="text" name="address" id="address" class="form-control">
                @endif

            </div>
            <div class="col-md-4 mb-2">
                <label for="phone">Phone No</label>
                @if ($contact)
                    <input type="number" name="phone" id="phone" class="form-control" value="{{ $contact->phone }}">
                @else
                    <input type="number" name="phone" id="phone" class="form-control">
                @endif

            </div>
            <div class="col-md-4 mb-2">
                <label for="po_box">P.O.Box</label>
                @if ($contact)
                    <input type="number" name="po_box" id="po_box" class="form-control" value="{{ $contact->po_box }}">
                @else
                    <input type="number" name="po_box" id="po_box" class="form-control">
                @endif
            </div>
            <div class="col-md-4 mb-2">
                <label for="email">Email</label>
                @if ($contact)
                    <input type="email" name="email" id="email" class="form-control" value="{{ $contact->email }}">
                @else
                    <input type="email" name="email" id="email" class="form-control">
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="shadow rounded p-3">
                    <h5 style="display: flex;justify-content: space-between;align-items: center">
                        <span>Individual Contact</span>
                        <button onclick="addContact()" class="btn btn-primary">
                            Add
                        </button>
                    </h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 ml-3"> <strong>Title</strong></div>
                        <div class="col-md-4 ml-3"> <strong>Name</strong></div>
                        <div class="col-md-4 ml-3"> <strong>Post</strong></div>
                    </div>
                    <div id="individual_contacts">
                        @if ($individualcontacts)
                            @foreach ($individualcontacts as $contact)
                                <hr id="hr_old_{{ $contact->id }}">
                                <div class="row" id="individual_contact_show_{{ $contact->id }}">
                                    <div class="col-md-4 mb-2">
                                        <input type="text" name="title_{{ $contact->id }}"
                                            id="title_{{ $contact->id }}" value="{{ $contact->title }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <input type="text" name="name_{{ $contact->id }}"
                                            id="name_{{ $contact->id }}" class="form-control"
                                            value="{{ $contact->name }}">
                                    </div>
                                    <div class="col-md-4 mb-2">

                                        <input type="text" name="post_{{ $contact->id }}"
                                            id="post_{{ $contact->id }}" class="form-control"
                                            value="{{ $contact->post }}">
                                    </div>
                                    <div class="col-md-12 text-start">
                                        <button class="btn btn-danger" onclick="delOld({{ $contact->id }})">
                                            Del
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 my-2 text-start">
                <button class="btn btn-primary" onclick="saveAll()">
                    Save Contact Setting
                </button>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        let contact_id = 0;

        function addContact() {
            $('#individual_contacts').append(`
            <hr id="hr_new_${contact_id}">
            <div class="row" id="individual_contact_${contact_id}">
            <div class="col-md-4 mb-2">

                <input type="text" name="title_${contact_id}" id="title_${contact_id}" class="form-control">
            </div>
            <div class="col-md-4 mb-2">

                <input type="text" name="name_${contact_id}" id="name_${contact_id}" class="form-control">
            </div>
            <div class="col-md-4 mb-2">

                <input type="text" name="post_${contact_id}" id="post_${contact_id}" class="form-control">
            </div>
            <div class="col-md-12 text-start"> <button class="btn btn-danger" onclick="delNew(${contact_id})">Del</button></div>
        </div>`);

            contact_id++

        }

        function saveAll() {
            var cname = $('#cname').val();
            var address = $('#address').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var po_box = $('#po_box').val();
            var individualContactsDatas = [];

            for (let i = 0; i < contact_id; i++) {
                var title = $(`#title_${i}`).val();
                var name = $(`#name_${i}`).val();
                var post = $(`#post_${i}`).val();

                individualContactsDatas.push({
                    title: title,
                    name: name,
                    post: post
                });
            }
            const data = {
                cname: cname,
                address: address,
                phone: phone,
                email: email,
                po_box: po_box,
                individualContactsDatas: individualContactsDatas,
            };

            axios.post('{{ route('admin.setting.contact.index') }}', data)
                .then(res => {
                    success('successfully Updated');
                })
                .catch(err => {
                    console.error(err);
                });
        };

        function delOld(id) {
            axios.get("{{ route('admin.setting.contact.del', ['contact_id' => ':id']) }}".replace(':id', id))
                .then(res => {
                    success('successfully deleted')
                    $(`#individual_contact_show_${id}`).remove();
                    $('#hr_old_' + id).remove();
                })
                .catch(err => {
                    console.error(err);
                })
        }

        function delNew(id) {
            $(`#individual_contact_${id}`).remove();
            $('#hr_new_' + id).remove();
        }
    </script>
@endsection
{{-- @extends('admin.layout.app')

@section('header-Links')
    <a href="{{ route('admin.setting.index') }}">Setting</a>
    <a href="{{ route('admin.setting.contact.index') }}">Contact</a>
@endsection

@section('active', 'setting')

@section('content')
    <div class="shadow mt-2 p-3 bg-white rounded">
        <div class="row mb-2">
            @foreach(['name' => 'Name', 'address' => 'Address', 'phone' => 'Phone No', 'po_box' => 'P.O.Box', 'email' => 'Email'] as $field => $label)
                <div class="col-md-4 mb-2">
                    <label for="{{ $field }}">{{ $label }}</label>
                    <input type="text" name="{{ $field }}" id="{{ $field }}" class="form-control"
                        value="{{ $contact ? $contact->$field : '' }}">
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12">
                <div class="shadow rounded p-3">
                    <h5 class="d-flex justify-content-between align-items-center">
                        <span>Individual Contact</span>
                        <button onclick="addContact()" class="btn btn-primary">Add</button>
                    </h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 ml-3"><strong>Title</strong></div>
                        <div class="col-md-4 ml-3"><strong>Name</strong></div>
                        <div class="col-md-4 ml-3"><strong>Post</strong></div>
                    </div>
                    <div id="individual_contacts">
                        @if ($individualcontacts)
                            @foreach ($individualcontacts as $contact)
                                <hr id="hr_old_{{ $contact->id }}">
                                <div class="row" id="individual_contact_show_{{ $contact->id }}">
                                    @foreach(['title', 'name', 'post'] as $field)
                                        <div class="col-md-4 mb-2">
                                            <input type="text" name="{{ $field }}_{{ $contact->id }}"
                                                id="{{ $field }}_{{ $contact->id }}" class="form-control"
                                                value="{{ $contact->$field }}">
                                        </div>
                                    @endforeach
                                    <div class="col-md-12 text-start">
                                        <button class="btn btn-danger" onclick="delOld({{ $contact->id }})">Del</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 my-2 text-start">
                <button class="btn btn-primary" onclick="saveAll()">Save Contact Setting</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let contact_id = 0;

        function addContact() {
            const newContactHtml = `
                <hr id="hr_new_${contact_id}">
                <div class="row" id="individual_contact_${contact_id}">
                    ${['title', 'name', 'post'].map(field => `
                        <div class="col-md-4 mb-2">
                            <input type="text" name="${field}_${contact_id}" id="${field}_${contact_id}" class="form-control">
                        </div>
                    `).join('')}
                    <div class="col-md-12 text-start">
                        <button class="btn btn-danger" onclick="delNew(${contact_id})">Del</button>
                    </div>
                </div>`;
            $('#individual_contacts').append(newContactHtml);
            contact_id++;
        }

        function saveAll() {
            const data = {
                cname: $('#cname').val(),
                address: $('#address').val(),
                phone: $('#phone').val(),
                email: $('#email').val(),
                po_box: $('#po_box').val(),
                individualContactsDatas: Array.from({ length: contact_id }, (_, i) => ({
                    title: $(`#title_${i}`).val(),
                    name: $(`#name_${i}`).val(),
                    post: $(`#post_${i}`).val(),
                })),
            };

            axios.post('{{ route('admin.setting.contact.index') }}', data)
                .then(() => success('Successfully Updated'))
                .catch(console.error);
        }

        function delOld(id) {
            axios.get("{{ route('admin.setting.contact.del', ['contact_id' => ':id']) }}".replace(':id', id))
                .then(() => {
                    success('Successfully deleted');
                    $(`#individual_contact_show_${id}, #hr_old_${id}`).remove();
                })
                .catch(console.error);
        }

        function delNew(id) {
            $(`#individual_contact_${id}, #hr_new_${id}`).remove();
        }
    </script>
@endsection --}}
