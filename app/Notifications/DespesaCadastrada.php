<?php

namespace App\Notifications;

use App\Models\Despesa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DespesaCadastrada extends Notification implements ShouldQueue
{
    use Queueable;

    protected $despesa;

    /**
     * Create a new notification instance.
     */
    public function __construct(Despesa $despesa)
    {
        $this->despesa = $despesa;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                        ->subject('Uma nova despesa foi cadastrada.')
                        ->line('Uma nova despesa foi cadastrada.')
                        ->action('Ver Despesa', url('/despesas/'.$this->despesa->id))
                        ->line('Descrição: ' . $this->despesa->descricao)
                        ->line('Data: ' . $this->despesa->data)
                        ->line('Valor: R$ ' . $this->despesa->valor);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'despesa_id' => $this->despesa->id,
            'descricao' => $this->despesa->descricao,
            'data' => $this->despesa->data,
            'valor' => $this->despesa->valor,
        ];
    }
}
