@extends('users.main')

@section('header-content')
    <div class="container fillter-section">
        <div class="row">
            <div class="col-sm-12">
                <select class="form-select bg-light form-select-sm fillter-category" aria-label="Default select example"
                    onchange="scrollToId()" id="selectBox">
                    <option>Semua</option>
                    <optgroup label="Warung">
                        @foreach ($row['outlets'] as $key => $value)
                            <option value="menu{{ $key }}">
                                {{ $value->outlet_name }}</option>
                        @endforeach
                    </optgroup>
                    {{-- <optgroup label="Kategori">
                        @foreach ($row['categories'] as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->category_name }}</option>
                        @endforeach
                    </optgroup> --}}
                </select>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        @foreach ($row['outlets'] as $key => $value)
            @if ($row['outlets'][$key]->products->count() != 0)
                <div class="product-wrap" id="menu{{ $key }}">
                    <h3 class="category-title">{{ $value->outlet_name }}</h3>
                    @foreach ($row['outlets'][$key]->products as $val)
                        <div class="product_list" data-bs-toggle="modal" data-bs-target="#productModal{{ $val->uuid }}">
                            <div class="d-flex">
                                <div class="p-2 flex-fill wrapper_image">
                                    <img loading="lazy" src="{{ asset($val->product_image) }}"
                                        class="rounded float-start thumbnail-product" alt="...">
                                </div>
                                <div class="p-2 flex-fill product_detail">
                                    <h4>{{ $val->active_product_name }}</h4>
                                    <p>{{ $val->description }}</p>
                                    @if ($val->is_available == 0)
                                        <span class="text-danger">Habis</span>
                                    @else
                                        @if ($val->price_promo == $val->price_display)
                                            <span>Rp. {{ number_format($val->price_display) }},-</span>
                                        @else
                                            <h5 class="slice">Rp. {{ number_format($val->price_display) }},-</h5>
                                            <span>Rp. {{ number_format($val->price_promo) }},-</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="line-1"></div>
                        {{-- Modal FullScreen --}}
                        <!-- Full screen modal -->
                        <!-- Modal -->
                        <div class="modal fade" data-easein="flipXIn" id="productModal{{ $val->uuid }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
                                <div class="modal-content modal-product">
                                    {{-- <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
                                    <div class="modal-body">
                                        <button type="button" class="btn-close close-modal" data-bs-dismiss="modal"
                                            aria-label="Close"></button>

                                        <img loading="lazy" src="{{ asset($val->product_image) }}"
                                            class="rounded img-fluid" alt="...">
                                        <div class="product-detail">
                                            <input type="hidden" id="uuid-{{ $val->uuid }}"
                                                value="{{ $val->uuid }}">
                                            <input type="hidden" id="product_name-{{ $val->uuid }}"
                                                value="{{ $val->active_product_name }}">
                                            <input type="hidden" id="description-{{ $val->uuid }}"
                                                value="{{ $val->description }}">
                                            <input type="hidden" name="product_image" id="image-{{ $val->uuid }}"
                                                value="{{ asset($val->product_image) }}">
                                            <h4>{{ $val->active_product_name }}</h4>
                                            <p>{{ $val->description }}</p>
                                            <input type="hidden" name="price_promo" id="price-promo-{{ $val->uuid }}"
                                                value="{{ $val->price_promo }}">
                                            <input type="hidden" name="price_display"
                                                id="price-display-{{ $val->uuid }}" value="{{ $val->price_display }}">
                                            @if ($val->is_available == 0)
                                                <span class="text-danger">Habis</span>
                                            @else
                                                @if ($val->price_promo == $val->price_display)
                                                    <span>Rp. {{ number_format($val->price_display) }},-</span>
                                                @else
                                                    <h5 class="slice">Rp. {{ number_format($val->price_display) }},-</h5>
                                                    <span>Rp. {{ number_format($val->price_promo) }},-</span>
                                                @endif
                                            @endif
                                            <div>
                                                <div class="varian">
                                                    <div class="d-flex justify-content-center mt-1000">
                                                        <div class="number-plus-minus">
                                                            <input disabled class="inputQty" name="product_qty"
                                                                id="qty-{{ $val->uuid }}" type="number" value=1 min=1
                                                                step="1" required />

                                                            <button id="{{ $val->uuid }}" type="button"
                                                                class="plus"></button>
                                                            <button id="{{ $val->uuid }}" type="button"
                                                                class="minus"></button>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    @if ($val->varians->count() > 0)
                                                        <div class="varian" id="add-form{{ $val->uuid }}">
                                                            <h4>Varian</h4>
                                                            <p id="requiredvarian{{ $val->uuid }}"
                                                                class="text-danger mb-2 d-none">Wajib
                                                                memilih varian</p>
                                                            <div class="swappy-radios" role="radiogroup"
                                                                aria-labelledby="swappy-radios-label">
                                                                @foreach ($val->varians as $i)
                                                                    <label>
                                                                        <input
                                                                            value="{{ $i->id }}|{{ $i->varian_name }}|{{ $i->varian_price }}"
                                                                            type="radio"
                                                                            name="varian-{{ $val->uuid }}" required />
                                                                        <span class="radio"></span>
                                                                        <span class="varian_name">{{ $i->varian_name }} -
                                                                            Rp.
                                                                            {{ number_format($i->varian_price) }},-</span>
                                                                    </label>
                                                                    <div class="line-1" style="margin-bottom : 20px;"></div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if ($val->toppings->count() > 0)
                                                        <div class="varian" id="toppings-{{ $val->uuid }}">
                                                            <h4>Topping</h4>
                                                            @foreach ($val->toppings as $p => $q)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="{{ $q->id }}|{{ $q->topping_name }}|{{ $q->topping_price }}"
                                                                        id="flexCheckDefault">
                                                                    <label class="form-check-label"
                                                                        for="flexCheckDefault">
                                                                        {{ $q->topping_name }} +Rp.
                                                                        {{ number_format($q->topping_price) }}
                                                                    </label>
                                                                </div>
                                                                <div class="line-1"></div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer sticky-bottom">
                                        @if ($val->is_available == 1)
                                            <button onclick="addToCart(`{{ $val->uuid }}`)" type="button"
                                                class="btn btn-sm btn-primary">Tambah Ke
                                                Keranjang</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Modal Fullscreen --}}
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>


    {{-- Floating Button --}}
    <a href="/carts" class="float">
        <span id="totalCart"></span>
        <i class='bx bx-cart my-float'></i>
    </a>
    {{-- End Floating --}}
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/velocity-animate@2.0/velocity.min.js"></script>
    <script>
        function totalCart() {
            var carts = JSON.parse(localStorage.getItem("carts") || "[]");
            $("#totalCart").html(carts.length);
        }

        // add the animation to the modal
        $(".product_list").on('click', function(index) {
            const inputQtyProduct = $('.inputQty');
            inputQtyProduct.val(1);
            inputQtyProduct.change();
        });



        // $(document).ready(function() {
        $('.minus').click(function() {
            const inputQtyProduct = $(this).parent().find('.inputQty');
            var count = parseInt(inputQtyProduct.val()) - 1;
            count = count < 1 ? 1 : count;
            inputQtyProduct.val(count);
            inputQtyProduct.change();
            addedForm(this.id, count)
            return false;
        });
        $('.plus').click(function() {
            const inputQtyProduct = $(this).parent().find('.inputQty');
            console.log(inputQtyProduct)
            var qty = parseInt(inputQtyProduct.val()) + 1;
            inputQtyProduct.val(qty);
            inputQtyProduct.change();
            addedForm(this.id, qty)
            return false;
        });

        function addedForm(uuid, qty) {
            console.log('qty = ', qty);
            var eId = 'add-form' + uuid;
            var element = document.getElementById(eId);
            console.log(eId)
            element.appendChild = '';
        }

        // });

        // Add to cart
        function addToCart(uuid) {
            var data = {};
            var total_price = 0;
            var varians = $(`input[name="varian-${uuid}"]:checked`).val();
            if ($(`#add-form${uuid}`).length) {
                if (varians == null) {
                    console.log('masuk sini');
                    var sVarian = document.getElementById(`add-form${uuid}`);
                    sVarian.scrollIntoView({
                        behavior: 'smooth'
                    }, true);
                    $(`#requiredvarian${uuid}`).removeClass("d-none");
                    return false
                } else {
                    $(`#requiredvarian${uuid}`).addClass("d-none");
                }
            }
            data['product_image'] = $(`#image-${uuid}`).val();
            var price_promo = parseInt($(`#price-promo-${uuid}`).val());
            var price_display = parseInt($(`#price-display-${uuid}`).val());
            data['uuid'] = $(`#uuid-${uuid}`).val();
            data['product_name'] = $(`#product_name-${uuid}`).val();
            data['description'] = $(`#description-${uuid}`).val();
            data['qty'] = parseInt($(`#qty-${uuid}`).val());

            if (varians != null) {
                var varianArray = varians.split("|");
                data['varian_id'] = parseInt(varianArray[0]);
                data['varian_name'] = varianArray[1];
                data['varian_price'] = parseInt(varianArray[2]);
            } else {
                if (price_display == price_promo) {
                    data['varian_price'] = price_display;
                } else {
                    data['varian_price'] = price_promo;
                }
            }
            total_price += data['varian_price'];


            var searchCheckbox = $(`#toppings-${uuid} input:checkbox:checked`).map(function() {
                return $(this).val();
            }).get();
            var toppings = [];
            for (var i = 0; i < searchCheckbox.length; i++) {
                var myArray = searchCheckbox[i].split("|");
                toppings[i] = {
                    "topping_name": myArray[1],
                    "topping_price": parseInt(myArray[2]),
                    "topping_id": parseInt(myArray[0])
                }
                total_price += parseInt(myArray[2]);
            }
            var price = total_price;
            total_price = total_price * data['qty'];
            data['toppings'] = toppings;
            data['total_price'] = total_price;
            data['price'] = price;
            var carts = JSON.parse(localStorage.getItem("carts") || "[]");
            console.log('cart awal :', carts)
            carts.push(data);
            console.log('carts after push', carts);
            localStorage.setItem("carts", JSON.stringify(carts));
            totalCart();
            $(`input[name="varian-${uuid}"]`).attr('checked', false);
            $(`#toppings-${uuid} input:checkbox`).attr('checked', false);
            Swal.fire({
                icon: 'success',
                // title: 'Berhasil',
                text: 'Berhasil Menambahkan Produk Ke keranjang!',
                footer: '<a href="/carts">Lihat Keranjang</a>'
            });

        }

        function scrollToId() {
            console.log('masuk');
            var selectBox = document.getElementById("selectBox");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            console.log(selectedValue)
            var access = document.getElementById(selectedValue);
            console.log(access)
            access.scrollIntoView({
                behavior: 'smooth',
                block: "end",
                inline: "nearest"
            }, true);
        }

        totalCart();
    </script>
@endsection
