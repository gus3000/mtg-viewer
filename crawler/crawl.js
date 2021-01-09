const mtg = require('mtgtop8');
const mysql = require('mysql');
const fs = require('fs');

const DOWNLOAD_DIR = './data/';
const DOWNLOAD_DIR_EVENTS = DOWNLOAD_DIR + 'events/';
const DOWNLOAD_DIR_DECKS = DOWNLOAD_DIR + 'decks/';

fs.mkdirSync(DOWNLOAD_DIR, {recursive: true});

function downloadEvents(start, callback) {
    console.log(start);
    downloadEvent(start, function (err, event) {
        if (err) return callback(err);
        setTimeout(downloadEvents, 100, start + 1, callback);
    });

}

function downloadEvent(eventId, callback) {
    let path = DOWNLOAD_DIR_EVENTS + eventId + '.json';
    fs.access(path, fs.F_OK, (err) => {
        if (err) {
            console.log(`${eventId} did not exist`);
            mtg.eventInfo(eventId, function (err, event) {
                if (err) return callback(err);
                // fs.writeFileSync(path, JSON.stringify(event));
                downloadEventDecks(eventId, event);
                callback(err, event);
            });
            return;
        }
        console.log(`${eventId} did not exist`);
    })
}

function downloadEventDecks(eventId, event) {
    for (const deck of event.decks) {
        downloadDeck(eventId, deck.id);
    }
}

function downloadDeck(eventId, deckId, callback) {
    // fs.exists
    mtg.deck(eventId, deckId, (err, deck) => {
        deck.event = eventId;
        fs.writeFileSync(DOWNLOAD_DIR_DECKS + deckId + '.json', JSON.stringify(deck));
    })
}

function syncEvents(start, callback) {
    console.log(start);

}

function syncEvent(eventId, callback) {
    let event = JSON.parse(fs.readFileSync(DOWNLOAD_DIR + eventId + '.json'));
    console.log(event);
    callback();
}

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'mypasswd',
    database: 'mtg'
});

// downloadDeck(1,101680,() => {});
// downloadEvent(1, () => {});
fs.access(DOWNLOAD_DIR_DECKS + '101681.json', fs.F_OK, (err) => {
    if (err) {
        console.log('nope');
        return;
    }
    console.log('yarp');
})


// /*
// connection.query('SELECT * from event', function (error, results, fields) {
//     if (error) throw error;
//     console.log(results);
//     let maxId = 0;
//     if (results.length > 0) {
//         //TODO
//     }
//     let i = maxId + 1;
//     // downloadEvents(i, () => {
//     //     connection.end();
//     // });
//     syncEvent(1, () => {
//         connection.end();
//     });
//
// });

// */
// mtg.event(1, function(err,e){
//     if(err) return console.error(err);
//     console.log(e);
// });