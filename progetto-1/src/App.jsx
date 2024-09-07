import React, { useState } from 'react';
import Navbar from './componenti/Navbar';
import EventCard from './componenti/EventCard';
import PurchaseMessage from './componenti/PurchaseMessage';


const App = () => {
  const [events, setEvents] = useState(eventsData);
  const [purchaseMessage, setPurchaseMessage] = useState('');

  const eventi = [
    {
      id: 1,
      name: 'AC/DC Power Up Festival',
      image: './immagini/evento_1.png',
      description: 'Concerto degli AC/DC il 25 maggio 2024.',
      cost: 59.90,
      date: '2024-05-25',
      time: '18:00',
      totalTickets: 0,
    },
    /*Aggiunta degli altri eventi*/
  ];

  const handleIncrement = (id) => {
    setEvents((prevEvents) =>
      prevEvents.map((event) =>
        event.id === id ? { ...event, totalTickets: event.totalTickets + 1 } : event
      )
    );
  };

  const handleDecrement = (id) => {
    setEvents((prevEvents) =>
      prevEvents.map((event) =>
        event.id === id && event.totalTickets > 0
          ? { ...event, totalTickets: event.totalTickets - 1 }
          : event
      )
    );
  };

  const handlePurchase = () => {
    setPurchaseMessage('Il carrello è stato svuotato e i prodotti sono stati acquistati correttamente!');
  };
/*in questo caso non inserisco il login perchè non si è in grado di saperlo */
  return (
    <div className="App">
      <Navbar />
      <PurchaseMessage message={purchaseMessage} />
      <div className="messaggio">Accesso eseguito come: Paolo Aimar</div>
      <div className="contenitore">
        <h1>Eventi disponibili per l'acquisto</h1>
        {events.map((event) => (
          <EventCard
            key={event.id}
            event={event}
            onIncrement={handleIncrement}
            onDecrement={handleDecrement}
          />
        ))}
        <div className="bottoniFinali">
          <button onClick={handlePurchase}>Aggiungi al carrello</button>
          <button type="reset">Cancella</button>
        </div>
      </div>
    </div>
  );
};

export default App;