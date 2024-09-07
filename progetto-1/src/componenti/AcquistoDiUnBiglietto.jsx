import React, { useState } from 'react';
import Eventi from './componenti/Eventi';

const eventsData = [
  {
    id: 1,
    name: "AC/DC Power Up Festival",
    imgSrc: "./immagini/evento_1.png",
    alt: "Evento 1, caricamento immagine",
    description: "In data 25 maggio 2024 si terrà un concerto degli AC/DC...",
    price: 59.90,
    dateTime: "2024-05-25T18:00",
    displayDate: "25 maggio 2024, ore 18:00"
  },
  /*inserisco altri eventi in questa parte, aumentando ogni volta l'id in quanto non è collegato ad un database vero e proprio*/
];

const TicketPurchasePage = () => {
  const [totalCost, setTotalCost] = useState(0);

  const AggiornaTotale = (amount) => {
    setTotalCost(prev => prev + amount);
  };

  return (
    <div className="contenitore">
      <h1>Eventi disponibili per l'acquisto</h1>
      {eventsData.map(event => (
        <Eventi key={event.id} event={event} onUpdateTotal={aggiornaTotale} />
      ))}
      <div className="totalSummary">
        Costo totale: {totalCost.toFixed(2)} €
      </div>
    </div>
  );
};
export default AcquistoDiUnBiglietto;