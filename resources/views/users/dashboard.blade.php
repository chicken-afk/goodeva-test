@extends('users.main')

@section('content')
    <div class="container">
        <div class="product-wrap">
            <h3 class="category-title">Makanan</h3>
            @for ($i = 0; $i < 2; $i++)
                <div class="product_list" data-bs-toggle="modal" data-bs-target="#costumModal11">
                    <div class="d-flex">
                        <div class="p-2 flex-fill wrapper_image">
                            <img loading="lazy" src="{{ asset('storage/images/product/ojqJRaQbVNzIW3pKimOT.png') }}"
                                class="rounded float-start thumbnail-product" alt="...">
                        </div>
                        <div class="p-2 flex-fill product_detail">
                            <h4>Nasi Goreng Seafood</h4>
                            <p>Nasi Goreng Khas Aceh Dengan Aroma Rempah Pilihan</p>
                            <h5 class="slice">Rp. 50.000,-</h5>
                            <span>Rp. 30.000,-</span>
                        </div>
                    </div>
                </div>
                <div class="line-1"></div>
                <div class="product_list">
                    <div class="d-flex">
                        <div class="p-2 flex-fill wrapper_image">
                            <img loading="lazy" src="{{ asset('storage/images/product/YTFRLpp4btpKUTFt15It.png') }}"
                                class="rounded float-start thumbnail-product" alt="...">
                        </div>
                        <div class="p-2 flex-fill product_detail">
                            <h4>Mie Aceh Spesial</h4>
                            <p>Mie Goreng Khas Aceh Dengan Aroma Rempah Pilihan</p>
                            <h5 class="slice">Rp. 45.000,-</h5>
                            <span>Rp. 35.000,-</span>
                        </div>
                    </div>
                </div>
                <div class="line-1"></div>
            @endfor
        </div>
        <div class="product-wrap">
            <h3 class="category-title">Minuman</h3>
            @for ($i = 0; $i < 10; $i++)
                <div class="product_list">
                    <div class="d-flex">
                        <div class="p-2 flex-fill wrapper_image">
                            <img loading="lazy" src="{{ asset('storage/images/product/A9Zmv10ELLHdelTXkmxs.png') }}"
                                class="rounded float-start thumbnail-product" alt="...">
                        </div>
                        <div class="p-2 flex-fill product_detail">
                            <h4>Caffee Lattee</h4>
                            <p>Kopi Nikmat gak bikin kembung</p>
                            <h5 class="slice">Rp. 22.500,-</h5>
                            <span>Rp. 20.000,-</span>
                        </div>
                    </div>
                </div>
                <div class="line-1"></div>
                <div class="product_list">
                    <div class="d-flex">
                        <div class="p-2 flex-fill wrapper_image">
                            <img loading="lazy" src="{{ asset('storage/images/product/QZMGNrdmgXsU4lT96JRp.png') }}"
                                class="rounded float-start thumbnail-product" alt="...">
                        </div>
                        <div class="p-2 flex-fill product_detail">
                            <h4>Americano</h4>
                            <p>Kopi Espresso campur air aja</p>
                            {{-- <h5 class="slice">Rp. 50.000,-</h5> --}}
                            <span>Rp. 18.000,-</span>
                        </div>
                    </div>
                </div>
                <div class="line-1"></div>
            @endfor
        </div>
    </div>


    {{-- Floating Button --}}
    <a href="#" class="float">
        <span>4</span>
        <i class='bx bx-cart my-float'></i>
    </a>
    {{-- End Floating --}}

    {{-- Modal FullScreen --}}
    <!-- Full screen modal -->
    <!-- Modal -->
    <div class="modal fade" data-easein="flipXIn" id="costumModal11" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen ">
            <div class="modal-content modal-product">
                {{-- <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> --}}
                <div class="modal-body">
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal"
                        aria-label="Close"></button>

                    <img loading="lazy" src="{{ asset('storage/images/product/ojqJRaQbVNzIW3pKimOT.png') }}"
                        class="rounded img-fluid" alt="...">
                    <div class="product-detail">
                        <h4>Nasi Goreng Seafood</h4>
                        <p>Nasi Goreng Khas Aceh Dengan Aroma Rempah Pilihan. Nasi Goreng Khas Aceh Dengan Aroma Rempah
                            Pilihan</p>
                        <h5 class="slice">Rp. 50.000,-</h5>
                        <span>Rp. 30.000,-</span>
                        <div class="varian">
                            <div class="d-flex justify-content-center mt-1000">
                                <div class="number-plus-minus">
                                    <input disabled class="inputQty" name="product_qty" id="prduct_qty" type="number"
                                        value=1 min=1 step="1" />

                                    <button type="button" class="plus"></button>
                                    <button type="button" class="minus"></button>

                                </div>
                            </div>
                        </div>
                        <div class="varian">
                            <h4>Varian</h4>
                            <div class="swappy-radios" role="radiogroup" aria-labelledby="swappy-radios-label">
                                <label>
                                    <input type="radio" name="varian[]" checked />
                                    <span class="radio"></span>
                                    <span class="varian_name">Biasa - Rp. 40.000,-</span>
                                </label>
                                <div class="line-1" style="margin-bottom : 20px;"></div>
                                <label>
                                    <input type="radio" name="varian[]" />
                                    <span class="radio"></span>
                                    <span class="varian_name">Spesial - Rp. 50.000,-</span>
                                </label>
                                <div class="line-1" style="margin-bottom : 20px;"></div>
                            </div>

                        </div>

                        <div class="varian">
                            <h4>Topping</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Telor Dadar +Rp. 7.000
                                </label>
                            </div>
                            <div class="line-1"></div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                                    checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Keju Mozarella +Rp. 15.000
                                </label>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="modal-footer sticky-bottom">
                    <button disabled type="button" class="btn btn-sm btn-primary">Tambah Ke Keranjang - Rp.
                        40.000,-</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Fullscreen --}}
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/velocity-animate@2.0/velocity.min.js"></script>
    <script>
        // add the animation to the modal
        $(".product_list").on('click', function(index) {
            const inputQtyProduct = $('.inputQty');
            inputQtyProduct.val(1);
            inputQtyProduct.change();
        });
        let currentValue = 1;
        const timeout = 0.3;
        const radios = document.querySelectorAll('.swappy-radios input');
        const fakeRadios = document.querySelectorAll('.swappy-radios .radio');

        //This next bit kinda sucks and could be improved.
        //For simplicity, I'm assuming that the distance between the first and second radios is indicative of the distance between all radios. This will fail if one of the options goes onto two lines.
        //I should really move each radio independantly depending on its own distance to its neighbour. Oh well ¯\_(ツ)_/¯
        //TODO ^^^
        const firstRadioY = document.querySelector('.swappy-radios label:nth-of-type(1) .radio').getBoundingClientRect().y;
        const secondRadioY = document.querySelector('.swappy-radios label:nth-of-type(2) .radio').getBoundingClientRect().y;
        const indicitiveDistance = secondRadioY - firstRadioY;
        //End suckyness :D

        //Apply CSS delays in JS, so that if JS doesn't load, it doesn't delay selected radio colour change
        //I'm applying background style delay here so that it doesn't appear slow if JS is disabled/broken
        fakeRadios.forEach(function(radio) {
            radio.style.cssText = `transition: background 0s ${timeout}s;`;
        });
        //Have to do this bit the long way (i.e. with a <style> element) becuase you can't do inline pseudo element syles
        const css = `.radio::after {transition: opacity 0s ${timeout}s;}`
        const head = document.head;
        const style = document.createElement('style');
        style.type = 'text/css';
        style.appendChild(document.createTextNode(css));
        head.appendChild(style);
        //End no-js animation fallbacks.

        radios.forEach(function(radio, i) {
            //Add an attr to make finding and styling the correct element a lot easier
            radio.parentElement.setAttribute('data-index', i + 1);

            //The meat: set up the change listener!
            radio.addEventListener('change', function() {
                //Stop weirdness of incomplete animation occuring. disable radios until complete.
                temporarilyDisable();

                //remove old style tag
                removeStyles();
                const nextValue = this.parentElement.dataset.index;

                const oldRadio = document.querySelector(`[data-index="${currentValue}"] .radio`);
                const newRadio = this.nextElementSibling;
                const oldRect = oldRadio.getBoundingClientRect();
                const newRect = newRadio.getBoundingClientRect();

                //Pixel distance between previous and newly-selected radios
                const yDiff = Math.abs(oldRect.y - newRect.y);

                //Direction. Is the new option higher or lower than the old option?
                const dirDown = oldRect.y - newRect.y > 0 ? true : false;

                //Figure out which unselected radios actually need to move 
                //(we don't necessarily want to move them all)
                const othersToMove = [];
                const lowEnd = Math.min(currentValue, nextValue);
                const highEnd = Math.max(currentValue, nextValue);

                const inBetweenies = range(lowEnd, highEnd, dirDown);
                let othersCss = '';
                inBetweenies.map(option => {
                    //If there's more than one, add a subtle stagger effect
                    const staggerDelay = inBetweenies.length > 1 ? 0.1 / inBetweenies.length *
                        option : 0;
                    othersCss += `
        [data-index="${option}"] .radio {
          animation: moveOthers ${timeout - staggerDelay}s ${staggerDelay}s;
        }
      `;
                });

                const css = `
      ${othersCss}
      [data-index="${currentValue}"] .radio { 
        animation: moveIt ${timeout}s; 
      }
      @keyframes moveIt {
        0% { transform: translateX(0); }
        33% { transform: translateX(-3rem) translateY(0); }
        66% { transform: translateX(-3rem) translateY(${dirDown ? '-' : ''}${yDiff}px); }
        100% { transform: translateX(0) translateY(${dirDown ? '-' : ''}${yDiff}px); }
      }
      @keyframes moveOthers {
        0% { transform: translateY(0); }
        33% { transform: translateY(0); }
        66% { transform: translateY(${dirDown ? '' : '-'}${indicitiveDistance}px); }
        100% { transform: translateY(${dirDown ? '' : '-'}${indicitiveDistance}px); }
      }
  `;
                appendStyles(css);
                currentValue = nextValue;
            });
        });

        function appendStyles(css) {
            const head = document.head;
            const style = document.createElement('style');
            style.type = 'text/css';
            style.id = 'swappy-radio-styles';
            style.appendChild(document.createTextNode(css));
            head.appendChild(style);
        }

        function removeStyles() {
            const node = document.getElementById('swappy-radio-styles');
            if (node && node.parentNode) {
                node.parentNode.removeChild(node);
            }
        }

        function range(start, end, dirDown) {
            let extra = 1;
            if (dirDown) {
                extra = 0;
            }
            return [...Array(end - start).keys()].map(v => start + v + extra);
        }

        function temporarilyDisable() {
            radios.forEach((item) => {
                item.setAttribute('disabled', true);
                setTimeout(() => {
                    item.removeAttribute('disabled');
                }, timeout * 1000);
            });
        }

        $(document).ready(function() {
            $('.minus').click(function() {
                const inputQtyProduct = $(this).parent().find('.inputQty');
                var count = parseInt(inputQtyProduct.val()) - 1;
                count = count < 1 ? 1 : count;
                inputQtyProduct.val(count);
                inputQtyProduct.change();
                return false;
            });
            $('.plus').click(function() {
                const inputQtyProduct = $(this).parent().find('.inputQty');
                console.log(inputQtyProduct)
                inputQtyProduct.val(parseInt(inputQtyProduct.val()) + 1);
                inputQtyProduct.change();
                return false;
            });
        });
    </script>
@endsection
