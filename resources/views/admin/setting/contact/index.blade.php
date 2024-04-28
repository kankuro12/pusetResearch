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
                @if ($contact == null)
                    <label for="cname">Name</label>
                    <input type="text" name="cname" id="cname" class="form-control">
                @else
                    <label for="cname">Name</label>
                    <input type="text" name="cname" id="cname" class="form-control" value="{{ $contact->name }}">
                @endif
            </div>
            <div class="col-md-4 mb-2">
                @if ($contact == null)
                    <label for="address">address</label>
                    <input type="text" name="address" id="address" class="form-control">
                @else
                    <label for="address">address</label>
                    <input type="text" name="address" id="address" class="form-control"
                        value="{{ $contact->address }}">
                @endif

            </div>
            <div class="col-md-4 mb-2">
                @if ($contact == null)
                    <label for="phone">Phone No</label>
                    <input type="number" name="phone" id="phone" class="form-control">
                @else
                    <label for="phone">Phone No</label>
                    <input type="number" name="phone" id="phone" class="form-control" value="{{ $contact->phone }}">
                @endif

            </div>
            <div class="col-md-4 mb-2">
                @if ($contact == null)
                    <label for="po_box">P.O.Box</label>
                    <input type="number" name="po_box" id="po_box" class="form-control">
                @else
                    <label for="po_box">P.O.Box</label>
                    <input type="number" name="po_box" id="po_box" class="form-control" value="{{ $contact->po_box }}">
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
            var individualContactsDatas = [];
            var cname = $('#cname').val();
            var address = $('#address').val();
            var phone = $('#phone').val();
            var po_box = $('#po_box').val();

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
            $('#individual_contacts').children('.row').each(function() {
                var id = $(this).attr('id').replace('individual_contact_show_', '');
                var title = $(`#title_${id}`).val();
                var name = $(`#name_${id}`).val();
                var post = $(`#post_${id}`).val();

                individualContactsDatas.push({
                    id: id,
                    title: title,
                    name: name,
                    post: post
                });
            });


            const data = {
                individualContactsDatas: individualContactsDatas,
                cname: cname,
                address: address,
                phone: phone,
                po_box: po_box,
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
