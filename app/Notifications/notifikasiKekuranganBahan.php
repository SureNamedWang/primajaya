<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Session;
use Redirect;

class notifikasiKekuranganBahan extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($bahans)
    {
        $this->bahans = $bahans;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //dd($this->bahans);
        $url = url('/produksi/'.$this->bahans->id);
        $mail = new MailMessage;
        $mail->from($this->bahans->email, $this->bahans->nama)
            ->subject('Kekurangan Bahan Order ID:'.$this->bahans->id)
            ->greeting('Terjadi Kekurangan Bahan!')
            ->line('Produksi untuk Order ID: '.$this->bahans->id.' tidak bisa dilakukan karena kekurangan bahan:');
        foreach($this->bahans as $bahans=>$jumlah){
            if($bahans!='id'||$bahans!='email'||$bahans!='nama'){
                $mail->line($bahans.' : '.$jumlah);
            }
        }
        $mail->action('Lihat Produksi', $url)
            ->line('Mohon segera lakukan pemesanan untuk melanjutkan proses produksi');
        // dd($mail);
        return ($mail);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
