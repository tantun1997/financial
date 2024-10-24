<?php

namespace App\Http\Livewire\Administrator;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Usermanagement extends Component
{
    protected $listeners = ['enableProcess', 'disableProcess', 'adminProcess', 'userProcess'];

    public function enableButton($id, $status, $name)
    {
        if ($status == 1) {
            $message = "คุณจะปิดใช้งาน";
            $text = "ผู้ใช้งาน : " . $name;
            $urls = "disableProcess";
        } elseif ($status == 0) {
            $message = "คุณจะเปิดใช้งาน";
            $text = "ผู้ใช้งาน : " . $name;
            $urls = "enableProcess";
        }

        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'message' => $message,
            'text' => $text,
            'id' => $id,
            'urls' => $urls,
        ]);
    }

    public function enableProcess($id)
    {
        DB::table('users')->where('id', $id)->update(['enable' => '1', 'updated_at' => Carbon::now()]);
        $this->dispatchBrowserEvent('swal:notification', [
            'type' => 'success',
            'message' => 'success',
            'text' => 'success',
            'urls' => 'usermanagement'
        ]);
    }

    public function disableProcess($id)
    {
        DB::table('users')->where('id', $id)->update(['enable' => '0', 'updated_at' => Carbon::now()]);
        $this->dispatchBrowserEvent('swal:notification', [
            'type' => 'success',
            'message' => 'success',
            'text' => 'success',
            'urls' => 'usermanagement'
        ]);
    }

    public function adminButton($id, $status, $name)
    {
        if ($status == 1) {
            $message = "คุณจะมอบสิทธิ์ผู้ใช้งานให้";
            $text = "ผู้ใช้งาน : " . $name;
            $urls = "userProcess";
        } elseif ($status == 0) {
            $message = "คุณจะมอบสิทธิ์ผู้ดูแลระบบให้";
            $text = "ผู้ใช้งาน : " . $name;
            $urls = "adminProcess";
        }

        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'message' => $message,
            'text' => $text,
            'id' => $id,
            'urls' => $urls,
        ]);
    }

    public function adminProcess($id)
    {
        DB::table('users')->where('id', $id)->update(['isAdmin' => '1', 'updated_at' => Carbon::now()]);
        $this->dispatchBrowserEvent('swal:notification', [
            'type' => 'success',
            'message' => 'success',
            'text' => 'success',
            'urls' => 'usermanagement'
        ]);
    }

    public function userProcess($id)
    {
        DB::table('users')->where('id', $id)->update(['isAdmin' => '0', 'updated_at' => Carbon::now()]);
        $this->dispatchBrowserEvent('swal:notification', [
            'type' => 'success',
            'message' => 'success',
            'text' => 'success',
            'urls' => 'usermanagement'
        ]);
    }

    public function render()
    {
        $datatablesUserManagementQuery = DB::table('vwUsersAuthen')
            ->select(
                'id',
                'fullName',
                'username',
                'isStatus',
                'isAdmin',
                // 'managerId',
                // 'managerName',
                'deptName',
                // 'updatedAt',
            )
            ->orderBy('isStatus', 'desc')
            ->orderBy('isAdmin', 'desc')
             ->get();
        return view('livewire.administrator.usermanagement', [
            'datatablesUserManagementQuery' => $datatablesUserManagementQuery
        ]);
    }
}
