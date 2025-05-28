@component('mail::message')

# {{ $emailData['building_name'] }} - {{ $emailData['company_name'] }} - {{ ucfirst($emailData['status']) }} - {{ $emailData['title'] }}

**{{ $emailData['company_name'] }}**

**{{ $emailData['title'] }}**

**Building Tax Nr:** {{ $emailData['tax_number'] }}

---

**{{ ucfirst($emailData['status']) }}**

{{ $emailData['description'] }}

---

**Files annexed** (attached to this email)

@endcomponent
