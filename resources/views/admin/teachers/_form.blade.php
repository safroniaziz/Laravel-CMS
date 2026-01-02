{{-- Shared Form Partial for Create/Edit --}}
<div class="card mb-5">
    <div class="card-header">
        <div class="card-title">
            <h3>Basic Information</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-6">
            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Name</label>
            <div class="col-lg-9">
                <input type="text" name="name" class="form-control form-control-solid" placeholder="Full name" value="{{ old('name', $teacher->name ?? '') }}" required />
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Role</label>
            <div class="col-lg-9">
                <select name="role" class="form-select form-select-solid" required>
                    <option value="">Select Role</option>
                    <option value="kaprodi" {{ old('role', $teacher->role ?? '') == 'kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                    <option value="dosen" {{ old('role', $teacher->role ?? '') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                </select>
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-3 col-form-label fw-semibold fs-6">Title/Position</label>
            <div class="col-lg-9">
                <input type="text" name="title" class="form-control form-control-solid" placeholder="e.g. Dosen Sistem Informasi" value="{{ old('title', $teacher->title ?? '') }}" />
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-3 col-form-label fw-semibold fs-6">Email</label>
            <div class="col-lg-9">
                <input type="email" name="email" class="form-control form-control-solid" placeholder="email@example.com" value="{{ old('email', $teacher->email ?? '') }}" />
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-3 col-form-label fw-semibold fs-6">Phone</label>
            <div class="col-lg-9">
                <input type="text" name="phone" class="form-control form-control-solid" placeholder="+62..." value="{{ old('phone', $teacher->phone ?? '') }}" />
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-3 col-form-label fw-semibold fs-6">LinkedIn URL</label>
            <div class="col-lg-9">
                <input type="url" name="linkedin" class="form-control form-control-solid" placeholder="https://linkedin.com/in/username" value="{{ old('linkedin', $teacher->linkedin ?? '') }}" />
                <div class="form-text">Full LinkedIn profile URL</div>
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-3 col-form-label fw-semibold fs-6">Google Scholar</label>
            <div class="col-lg-9">
                <input type="url" name="google_scholar" class="form-control form-control-solid" placeholder="https://scholar.google.com/citations?user=..." value="{{ old('google_scholar', $teacher->google_scholar ?? '') }}" />
                <div class="form-text">Google Scholar profile URL</div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-5">
    <div class="card-header">
        <div class="card-title">
            <h3>Academic Information</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-6">
            <label class="col-lg-3 col-form-label fw-semibold fs-6">Expertise</label>
            <div class="col-lg-9">
                <input type="text" id="expertise" name="expertise" class="form-control form-control-solid" placeholder="Add expertise (comma separated)" value="{{ old('expertise', isset($teacher->expertise) ? implode(', ', $teacher->expertise) : '') }}" />
                <div class="form-text">Separate multiple expertise with commas</div>
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-3 col-form-label fw-semibold fs-6">Publications</label>
            <div class="col-lg-9">
                <input type="number" name="publications" class="form-control form-control-solid" placeholder="Number of publications" value="{{ old('publications', $teacher->publications ?? 0) }}" min="0" />
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-3 col-form-label fw-semibold fs-6">Projects</label>
            <div class="col-lg-9">
                <input type="number" name="projects" class="form-control form-control-solid" placeholder="Number of projects" value="{{ old('projects', $teacher->projects ?? 0) }}" min="0" />
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-3 col-form-label fw-semibold fs-6">Bio</label>
            <div class="col-lg-9">
                <textarea name="bio" class="form-control form-control-solid" rows="4" placeholder="Teacher biography">{{ old('bio', $teacher->bio ?? '') }}</textarea>
            </div>
        </div>
    </div>
</div>

<div class="card mb-5">
    <div class="card-header">
        <div class="card-title">
            <h3>Display Settings</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-6">
            <label class="col-lg-3 col-form-label fw-semibold fs-6">Photo</label>
            <div class="col-lg-9">
                <input type="file" name="photo" class="form-control form-control-solid" accept="image/*" />
                @if(isset($teacher) && $teacher->photo)
                    <div class="mt-3">
                        <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" style="max-width: 200px; border-radius: 8px;" />
                    </div>
                @endif
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-3 col-form-label fw-semibold fs-6">Gradient</label>
            <div class="col-lg-9">
                <select name="gradient" class="form-select form-select-solid">
                    <option value="linear-gradient(135deg, #1a246a, #151945)" {{ old('gradient', $teacher->gradient ?? '') == 'linear-gradient(135deg, #1a246a, #151945)' ? 'selected' : '' }}>Navy Blue</option>
                    <option value="linear-gradient(135deg, #f59e0b, #d97706)" {{ old('gradient', $teacher->gradient ?? '') == 'linear-gradient(135deg, #f59e0b, #d97706)' ? 'selected' : '' }}>Orange</option>
                    <option value="linear-gradient(135deg, #1d4ed8, #151945)" {{ old('gradient', $teacher->gradient ?? '') == 'linear-gradient(135deg, #1d4ed8, #151945)' ? 'selected' : '' }}>Blue</option>
                    <option value="linear-gradient(135deg, #059669, #047857)" {{ old('gradient', $teacher->gradient ?? '') == 'linear-gradient(135deg, #059669, #047857)' ? 'selected' : '' }}>Green</option>
                    <option value="linear-gradient(135deg, #ef4444, #dc2626)" {{ old('gradient', $teacher->gradient ?? '') == 'linear-gradient(135deg, #ef4444, #dc2626)' ? 'selected' : '' }}>Red</option>
                    <option value="linear-gradient(135deg, #8b5cf6, #7c3aed)" {{ old('gradient', $teacher->gradient ?? '') == 'linear-gradient(135deg, #8b5cf6, #7c3aed)' ? 'selected' : '' }}>Purple</option>
                </select>
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-3 col-form-label fw-semibold fs-6">Icon</label>
            <div class="col-lg-9">
                <select name="icon" class="form-select form-select-solid">
                    <option value="fa-user-tie" {{ old('icon', $teacher->icon ?? '') == 'fa-user-tie' ? 'selected' : '' }}>User Tie</option>
                    <option value="fa-user-graduate" {{ old('icon', $teacher->icon ?? '') == 'fa-user-graduate' ? 'selected' : '' }}>Graduate</option>
                    <option value="fa-user-cog" {{ old('icon', $teacher->icon ?? '') == 'fa-user-cog' ? 'selected' : '' }}>User Cog</option>
                    <option value="fa-user-check" {{ old('icon', $teacher->icon ?? '') == 'fa-user-check' ? 'selected' : '' }}>User Check</option>
                    <option value="fa-user-shield" {{ old('icon', $teacher->icon ?? '') == 'fa-user-shield' ? 'selected' : '' }}>User Shield</option>
                    <option value="fa-user-secret" {{ old('icon', $teacher->icon ?? '') == 'fa-user-secret' ? 'selected' : '' }}>User Secret</option>
                </select>
            </div>
        </div>

        <div class="row mb-6" id="badge-color-field" style="display: none;">
            <label class="col-lg-3 col-form-label fw-semibold fs-6">Badge Color (Kaprodi)</label>
            <div class="col-lg-9">
                <input type="color" name="badge_color" class="form-control form-control-solid form-control-color" value="{{ old('badge_color', $teacher->badge_color ?? '#fbbf24') }}" />
                <div class="form-text">Used for Kaprodi badge</div>
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-3  col-form-label fw-semibold fs-6">Order</label>
            <div class="col-lg-9">
                <input type="number" name="order" class="form-control form-control-solid" placeholder="Display order" value="{{ old('order', $teacher->order ?? '') }}" min="1" />
            </div>
        </div>

        <div class="row mb-6">
            <label class="col-lg-3 col-form-label fw-semibold fs-6">Status</label>
            <div class="col-lg-9">
                <div class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $teacher->is_active ?? true) ? 'checked' : '' }} />
                    <label class="form-check-label">Active</label>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Show/hide badge color based on role
function toggleBadgeField() {
    const role = $('select[name="role"]').val();
    if (role === 'kaprodi') {
        $('#badge-color-field').slideDown();
    } else {
        $('#badge-color-field').slideUp();
    }
}

// Initial state
$(document).ready(function() {
    toggleBadgeField();
    
    // On role change
    $('select[name="role"]').on('change', toggleBadgeField);
});
</script>
@endpush
