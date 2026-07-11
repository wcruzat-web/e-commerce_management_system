{{--
    ERP MODULE: Checkout — Shipping & Contact Details (Checkout Page)
    COMPONENT: Checkout Details Form
    DESCRIPTION: Contact info + shipping address form. Submits to CheckoutController@store.
    DATA SOURCE: $cart, $summary from controller
    ToDo: Prefill fields from authenticated customer profile when login is built
--}}

<div class="lg:col-span-2 bg-white border border-gray-200 rounded-2xl p-5 shadow-sm h-fit">
    <div class="flex items-center gap-2 mb-5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="1" y="3" width="15" height="13"></rect>
            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
            <circle cx="5.5" cy="18.5" r="2.5"></circle>
            <circle cx="18.5" cy="18.5" r="2.5"></circle>
        </svg>
        <h2 class="text-sm font-semibold text-gray-900">Checkout Details</h2>
    </div>

    {{-- form submits to POST /checkout — CheckoutController@store --}}
    {{-- ToDo: When login is built, pre-fill these fields from the authenticated customer's profile --}}
    <form method="POST" action="{{ route('checkout.store') }}" class="space-y-4">
        @csrf

        {{-- Name --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="first_name" class="block text-xs font-medium text-gray-600 mb-1.5">First Name</label>
                <input type="text" name="first_name" id="first_name" placeholder="Alex" required
                    class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent @error('first_name') border-red-400 @enderror">
                @error('first_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="last_name" class="block text-xs font-medium text-gray-600 mb-1.5">Last Name</label>
                <input type="text" name="last_name" id="last_name" placeholder="Morgan" required
                    class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent @error('last_name') border-red-400 @enderror">
                @error('last_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Contact --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="shipping_email" class="block text-xs font-medium text-gray-600 mb-1.5">Email</label>
                <input type="email" name="shipping_email" id="shipping_email" placeholder="alex@gmail.com" required
                    class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent @error('shipping_email') border-red-400 @enderror">
                @error('shipping_email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="shipping_phone" class="block text-xs font-medium text-gray-600 mb-1.5">Phone</label>
                <input type="tel" name="shipping_phone" id="shipping_phone" placeholder="+1 (555) 000-0000"
                    class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent @error('shipping_phone') border-red-400 @enderror">
                @error('shipping_phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Shipping Address --}}
        {{-- ToDo: When login is built, pre-select the default address automatically --}}
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-2">Shipping Address</label>

            {{-- Saved address cards --}}
            @if($addresses->count())
                <div id="savedAddressCards" class="space-y-3 mb-4">
                    @foreach ($addresses as $address)
                        <label class="address-card block border border-gray-200 rounded-xl p-4 cursor-pointer transition-colors hover:border-cyan-300 {{ $address->is_default ? 'border-cyan-500 bg-cyan-50/40' : '' }}"
                               data-street="{{ $address->street }}"
                               data-barangay="{{ $address->barangay }}"
                               data-city="{{ $address->city }}"
                               data-province="{{ $address->province }}"
                               data-postal="{{ $address->postal_code }}"
                               data-country="{{ $address->country }}"
                               data-type="{{ $address->address_type }}">
                             <input type="radio" name="selected_address" value="{{ $address->address_id }}" class="hidden" {{ $address->is_default ? 'checked' : '' }}>
                             <div class="flex items-start justify-between">
                                 <div>
                                     <div class="flex items-center gap-2 mb-1">
                                         @if($address->is_default)
                                             <span class="text-[10px] font-semibold bg-cyan-100 text-cyan-700 px-2 py-0.5 rounded-full">DEFAULT</span>
                                         @endif
                                         <span class="text-[10px] font-medium text-gray-400 uppercase">{{ $address->address_type }}</span>
                                     </div>
                                     <p class="text-xs text-gray-500">{{ $address->street }}, {{ $address->barangay }}</p>
                                     <p class="text-xs text-gray-500">{{ $address->city }}, {{ $address->province }} {{ $address->postal_code }}</p>
                                </div>
                                <div class="flex flex-col items-end gap-1 shrink-0 mt-1">
                                    <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center {{ $address->is_default ? 'border-cyan-500' : 'border-gray-300' }}">
                                        <div class="w-2.5 h-2.5 rounded-full {{ $address->is_default ? 'bg-cyan-500' : '' }}"></div>
                                    </div>
                                    <button type="button" class="edit-address-btn text-gray-300 hover:text-cyan-500 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            @endif

            {{-- Address fields container (hidden until populated) --}}
            <div id="addressFields" class="{{ $addresses->where('is_default', true)->count() ? '' : 'hidden' }}">
                <input type="hidden" name="address_type" id="address_type" value="Home">
                <input type="hidden" name="street" id="street">
                <input type="hidden" name="barangay" id="barangay">
                <input type="hidden" name="city" id="city">
                <input type="hidden" name="province" id="province">
                <input type="hidden" name="postal_code" id="postal_code">
                <input type="hidden" name="country" id="country">
            </div>

            <button type="button" id="addAddressBtn" onclick="openAddressModal(true)"
                class="w-full flex items-center justify-center gap-2 border-2 border-dashed border-gray-300 rounded-xl py-3 text-sm font-medium text-gray-500 hover:border-cyan-400 hover:text-cyan-500 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Use Another Address
            </button>
        </div>

        {{-- Address Modal Overlay --}}
        <div id="addressModal" class="fixed inset-0 z-50 hidden bg-black/40 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold text-gray-900">Shipping Address</h3>
                    <button type="button" onclick="closeAddressModal()" class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="space-y-3">
                    <input type="hidden" id="modal_address_id">
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Address Type</label>
                            <select id="modal_type"
                                class="w-full px-3 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-400">
                                <option value="Home">Home</option>
                                <option value="Work">Work</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Street</label>
                            <input type="text" id="modal_street" placeholder="123 Tech Boulevard"
                                class="w-full px-3 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-400">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Barangay</label>
                        <input type="text" id="modal_barangay" placeholder="Silicon Valley"
                            class="w-full px-3 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-400">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">City</label>
                            <input type="text" id="modal_city" placeholder="San Francisco"
                                class="w-full px-3 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-400">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Province</label>
                            <input type="text" id="modal_province" placeholder="California"
                                class="w-full px-3 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-400">
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Postal Code</label>
                            <input type="text" id="modal_postal" placeholder="94105"
                                class="w-full px-3 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-400">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs text-gray-500 mb-1">Country</label>
                            <input type="text" id="modal_country" placeholder="United States"
                                class="w-full px-3 py-2.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-400">
                        </div>
                    </div>
                    <button type="button" onclick="useAddressFromModal()"
                        class="w-full bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-semibold py-2.5 rounded-lg transition-colors">
                        Use This Address
                    </button>
                </div>
            </div>
        </div>

        {{-- Notes --}}
        <div>
            <label for="notes" class="block text-xs font-medium text-gray-600 mb-1.5">Order Notes (optional)</label>
            <textarea name="notes" id="notes" rows="2" placeholder="Any special instructions..." class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-200 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent">{{ old('notes') }}</textarea>
        </div>

        <button type="submit"
            class="w-full flex items-center justify-center gap-2 bg-cyan-500 hover:bg-cyan-600 transition-colors text-white text-sm font-semibold py-3 rounded-xl">
            Continue to Payment
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    </form>
</div>

<script>
    document.querySelectorAll('.address-card').forEach(card => {
        const editBtn = card.querySelector('.edit-address-btn');
        if (editBtn) {
            editBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                openAddressModal(true, {
                    address_id: card.querySelector('input[type=radio]').value,
                    address_type: card.dataset.type,
                    street: card.dataset.street,
                    barangay: card.dataset.barangay,
                    city: card.dataset.city,
                    province: card.dataset.province,
                    postal_code: card.dataset.postal,
                    country: card.dataset.country,
                });
            });
        }

        card.addEventListener('click', function() {
            document.querySelectorAll('.address-card').forEach(c => {
                c.classList.remove('border-cyan-500', 'bg-cyan-50/40');
                c.classList.add('border-gray-200');
                c.querySelector('.w-2\\.5').classList.remove('bg-cyan-500');
                c.querySelector('.w-5').classList.remove('border-cyan-500');
                c.querySelector('.w-5').classList.add('border-gray-300');
            });
            this.classList.remove('border-gray-200');
            this.classList.add('border-cyan-500', 'bg-cyan-50/40');
            this.querySelector('.w-2\\.5').classList.add('bg-cyan-500');
            this.querySelector('.w-5').classList.remove('border-gray-300');
            this.querySelector('.w-5').classList.add('border-cyan-500');
            this.querySelector('input[type=radio]').checked = true;

            fillAddressFields(this.dataset.street, this.dataset.barangay, this.dataset.city, this.dataset.province, this.dataset.postal, this.dataset.country, this.dataset.type);
            document.getElementById('addressFields').classList.remove('hidden');
        });
    });

    function fillAddressFields(street, barangay, city, province, postal, country, type) {
        document.getElementById('street').value = street;
        document.getElementById('barangay').value = barangay;
        document.getElementById('city').value = city;
        document.getElementById('province').value = province;
        document.getElementById('postal_code').value = postal;
        document.getElementById('country').value = country;
        if (type) document.getElementById('address_type').value = type;
    }

    function openAddressModal(clear, addr) {
        if (clear && addr) {
            document.getElementById('modal_address_id').value = addr.address_id || '';
            document.getElementById('modal_type').value = addr.address_type || 'Home';
            document.getElementById('modal_street').value = addr.street || '';
            document.getElementById('modal_barangay').value = addr.barangay || '';
            document.getElementById('modal_city').value = addr.city || '';
            document.getElementById('modal_province').value = addr.province || '';
            document.getElementById('modal_postal').value = addr.postal_code || '';
            document.getElementById('modal_country').value = addr.country || '';
        } else if (clear) {
            ['modal_address_id','modal_street','modal_barangay','modal_city','modal_province','modal_postal','modal_country'].forEach(id => document.getElementById(id).value = '');
            document.getElementById('modal_type').value = 'Home';
        } else {
            document.getElementById('modal_street').value = document.getElementById('street').value;
            document.getElementById('modal_barangay').value = document.getElementById('barangay').value;
            document.getElementById('modal_city').value = document.getElementById('city').value;
            document.getElementById('modal_province').value = document.getElementById('province').value;
            document.getElementById('modal_postal').value = document.getElementById('postal_code').value;
            document.getElementById('modal_country').value = document.getElementById('country').value;
            document.getElementById('modal_type').value = document.getElementById('address_type').value || 'Home';
        }
        document.getElementById('addressModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeAddressModal() {
        document.getElementById('addressModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function esc(str) {
        const d = document.createElement('div');
        d.textContent = str;
        return d.innerHTML;
    }

    function updateAddressCard(card, addr) {
        card.setAttribute('data-street', addr.street);
        card.setAttribute('data-barangay', addr.barangay);
        card.setAttribute('data-city', addr.city);
        card.setAttribute('data-province', addr.province);
        card.setAttribute('data-postal', addr.postal_code);
        card.setAttribute('data-country', addr.country);
        card.setAttribute('data-type', addr.address_type);

        card.querySelector('input[type=radio]').value = addr.address_id;
        const typeSpan = card.querySelector('.text-gray-400.uppercase');
        if (typeSpan) typeSpan.textContent = addr.address_type;
        const lines = card.querySelectorAll('.text-xs.text-gray-500');
        if (lines[0]) lines[0].textContent = addr.street + ', ' + addr.barangay;
        if (lines[1]) lines[1].textContent = addr.city + ', ' + addr.province + ' ' + addr.postal_code;
    }

    function useAddressFromModal() {
        const street = document.getElementById('modal_street').value.trim();
        const barangay = document.getElementById('modal_barangay').value.trim();
        if (!street || !barangay) {
            toastNotify('error', 'Please fill in at least the Street and Barangay fields.');
            return;
        }

        const payload = {
            address_id: document.getElementById('modal_address_id').value || null,
            address_type: document.getElementById('modal_type').value,
            street: street,
            barangay: barangay,
            city: document.getElementById('modal_city').value.trim(),
            province: document.getElementById('modal_province').value.trim(),
            postal_code: document.getElementById('modal_postal').value.trim(),
            country: document.getElementById('modal_country').value.trim(),
        };

        fetch('{{ route('checkout.address.save') }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify(payload),
        })
        .then(r => r.json())
        .then(data => {
            const addr = data.address;
            fillAddressFields(addr.street, addr.barangay, addr.city, addr.province, addr.postal_code, addr.country, addr.address_type);
            document.getElementById('addressFields').classList.remove('hidden');
            closeAddressModal();

            const existingCard = document.querySelector('.address-card input[type=radio][value="' + addr.address_id + '"]');
            if (existingCard) {
                updateAddressCard(existingCard.closest('.address-card'), addr);
                existingCard.closest('.address-card').click();
            } else {
                addAddressCard(addr);
            }
            toastNotify('success', 'Address saved!');
        })
        .catch(() => toastNotify('error', 'Failed to save address.'));
    }

    function addAddressCard(addr) {
        let wrap = document.getElementById('savedAddressCards');
        if (!wrap) {
            wrap = document.createElement('div');
            wrap.id = 'savedAddressCards';
            wrap.className = 'space-y-3 mb-4';
            document.getElementById('addAddressBtn').insertAdjacentElement('beforebegin', wrap);
        }

        const card = document.createElement('label');
        card.className = 'address-card block border border-gray-200 rounded-xl p-4 cursor-pointer transition-colors hover:border-cyan-300 border-cyan-500 bg-cyan-50/40';
        card.setAttribute('data-street', addr.street);
        card.setAttribute('data-barangay', addr.barangay);
        card.setAttribute('data-city', addr.city);
        card.setAttribute('data-province', addr.province);
        card.setAttribute('data-postal', addr.postal_code);
        card.setAttribute('data-country', addr.country);
        card.setAttribute('data-type', addr.address_type);

        const isDefault = addr.is_default;
        card.innerHTML = `
            <input type="radio" name="selected_address" value="${addr.address_id}" class="hidden" ${isDefault ? 'checked' : ''}>
            <div class="flex items-start justify-between">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        ${isDefault ? '<span class="text-[10px] font-semibold bg-cyan-100 text-cyan-700 px-2 py-0.5 rounded-full">DEFAULT</span>' : ''}
                        <span class="text-[10px] font-medium text-gray-400 uppercase">${esc(addr.address_type)}</span>
                    </div>
                    <p class="text-xs text-gray-500">${esc(addr.street)}, ${esc(addr.barangay)}</p>
                    <p class="text-xs text-gray-500">${esc(addr.city)}, ${esc(addr.province)} ${esc(addr.postal_code)}</p>
                </div>
                <div class="flex flex-col items-end gap-1 shrink-0 mt-1">
                    <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center ${isDefault ? 'border-cyan-500' : 'border-gray-300'}">
                        <div class="w-2.5 h-2.5 rounded-full ${isDefault ? 'bg-cyan-500' : ''}"></div>
                    </div>
                    <button type="button" class="edit-address-btn text-gray-300 hover:text-cyan-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `;

        card.querySelector('.edit-address-btn').addEventListener('click', function(e) {
            e.stopPropagation();
            openAddressModal(true, addr);
        });

        wrap.prepend(card);

        card.addEventListener('click', function() {
            document.querySelectorAll('.address-card').forEach(c => {
                c.classList.remove('border-cyan-500', 'bg-cyan-50/40');
                c.classList.add('border-gray-200');
                const dot = c.querySelector('.w-2\\.5');
                const ring = c.querySelector('.w-5');
                if (dot) dot.classList.remove('bg-cyan-500');
                if (ring) { ring.classList.remove('border-cyan-500'); ring.classList.add('border-gray-300'); }
            });
            this.classList.remove('border-gray-200');
            this.classList.add('border-cyan-500', 'bg-cyan-50/40');
            const dot = this.querySelector('.w-2\\.5');
            const ring = this.querySelector('.w-5');
            if (dot) dot.classList.add('bg-cyan-500');
            if (ring) { ring.classList.remove('border-gray-300'); ring.classList.add('border-cyan-500'); }
            this.querySelector('input[type=radio]').checked = true;
            fillAddressFields(this.dataset.street, this.dataset.barangay, this.dataset.city, this.dataset.province, this.dataset.postal, this.dataset.country, this.dataset.type);
            document.getElementById('addressFields').classList.remove('hidden');
        });

        card.click();
    }

    document.getElementById('addressModal').addEventListener('click', function(e) {
        if (e.target === this) closeAddressModal();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const defaultCard = document.querySelector('.address-card input[type=radio]:checked');
        if (defaultCard) {
            defaultCard.closest('.address-card').click();
        } else {
            const hasCards = document.querySelectorAll('.address-card').length > 0;
            if (!hasCards) {
                openAddressModal(true);
            }
        }
    });

    function toastNotify(type, message) {
        const container = document.getElementById('toastContainer');
        if (!container) return;
        const colors = { success: 'bg-green-500', error: 'bg-red-500', info: 'bg-blue-500' };
        const toast = document.createElement('div');
        toast.className = `${colors[type] || 'bg-gray-700'} text-white text-xs px-4 py-2.5 rounded-lg shadow-lg opacity-0 transition-opacity duration-300`;
        toast.textContent = message;
        container.appendChild(toast);
        requestAnimationFrame(() => toast.style.opacity = '1');
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
</script>
