<?php

namespace App\Observers;

use App\Models\Anggota;

class AnggotaObserver
{
    /**
     * Handle the Anggota "created" event.
     */
    public function created(Anggota $anggota): void
    {
        audit_log('CREATE', 'Anggota', 'Tambah ahli: '.$anggota->nama);
    }

    /**
     * Handle the Anggota "updated" event.
     */
    public function updated(Anggota $anggota): void
    {
        audit_log('UPDATE', 'Anggota', 'Update ahli: '.$anggota->nama.' (ID: '.$anggota->id.')');
    }

    /**
     * Handle the Anggota "deleted" event.
     */
    public function deleted(Anggota $anggota): void
    {
        audit_log('DELETE', 'Anggota', 'Padam ahli: '.$anggota->nama.' (ID: '.$anggota->id.')');
    }

    /**
     * Handle the Anggota "restored" event.
     */
    public function restored(Anggota $anggota): void
    {
        //
    }

    /**
     * Handle the Anggota "force deleted" event.
     */
    public function forceDeleted(Anggota $anggota): void
    {
        //
    }
}
