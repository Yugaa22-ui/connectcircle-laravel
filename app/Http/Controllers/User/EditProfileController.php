<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\Interest;

class EditProfileController extends Controller
{
    /**
     * Menampilkan form edit profil
     */
    public function edit()
    {
        $user = Auth::user();

        // Ambil semua interest
        $all_interests = Interest::all();

        // Ambil interest milik user (array id)
        $user_interests = $user->interests->pluck('id')->toArray();

        return view('user.edit_profile', [
            'user' => $user,
            'all_interests' => $all_interests,
            'user_interests' => $user_interests
        ]);
    }

    /**
     * Memproses update profil
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $old_profile_picture = $user->profile_picture;

        // Validasi awal
        $validated = $request->validate([
            'username'   => 'required|string|max:255',
            'email'      => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'city'       => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'bio'        => 'nullable|string|max:500',
            'interests'  => 'required|array|min:1|max:3',
            'interests.*'=> 'integer|exists:interests,id',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'cropped_image'   => 'nullable|string'
        ], [
            'interests.min' => 'Pilih minimal 1 minat.',
            'interests.max' => 'Maksimal hanya bisa memilih 3 minat.'
        ]);

        $uploaded_new_photo = false;

        // === Jika pakai cropper base64
        if (!empty($validated['cropped_image'])) {
            $data = $validated['cropped_image'];
            if (strpos($data, ',') !== false) {
                list(, $data) = explode(',', $data);
            }
            $data = base64_decode($data);

            $new_filename = 'user_' . $user->id . '_' . time() . '.png';
            Storage::disk('public')->put('uploads/' . $new_filename, $data);

            // Hapus foto lama
            if ($old_profile_picture && Storage::disk('public')->exists('uploads/' . $old_profile_picture)) {
                Storage::disk('public')->delete('uploads/' . $old_profile_picture);
            }

            $user->profile_picture = $new_filename;
            $uploaded_new_photo = true;
        }

        // === Upload biasa
        if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
            $ext = strtolower($request->file('profile_picture')->getClientOriginalExtension());
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($ext, $allowed)) {
                $new_filename = 'user_' . $user->id . '_' . time() . '.' . $ext;
                $request->file('profile_picture')->storeAs('uploads', $new_filename, 'public');

                if ($old_profile_picture && Storage::disk('public')->exists('uploads/' . $old_profile_picture)) {
                    Storage::disk('public')->delete('uploads/' . $old_profile_picture);
                }

                $user->profile_picture = $new_filename;
                $uploaded_new_photo = true;
            } else {
                return back()->withErrors(['profile_picture' => 'Format file tidak didukung.']);
            }
        }

        // Cek apakah tidak ada perubahan
        $currentInterests = $user->interests->pluck('id')->sort()->values()->toArray();
        $newInterests     = collect($validated['interests'])->sort()->values()->toArray();

        $noChanges =
            !$uploaded_new_photo &&
            $validated['username'] == $user->username &&
            $validated['email'] == $user->email &&
            ($validated['city'] ?? '') == ($user->city ?? '') &&
            ($validated['profession'] ?? '') == ($user->profession ?? '') &&
            ($validated['bio'] ?? '') == ($user->bio ?? '') &&
            empty(array_diff($currentInterests, $newInterests)) &&
            empty(array_diff($newInterests, $currentInterests));

        if ($noChanges) {
            return back()->with('warning', 'Tidak ada perubahan yang dilakukan.');
        }

        // Simpan perubahan
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->city = $validated['city'];
        $user->profession = $validated['profession'];
        $user->bio = $validated['bio'];
        $user->save();

        // Update minat (pivot)
        $user->interests()->sync($validated['interests']);

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
