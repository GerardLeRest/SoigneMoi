
from flask import Flask, jsonify

app = Flask(__name__)

# Une liste contenant des informations sur deux personnes
personnes = [
    {"first_name": "Jean", "surname": "Dupont", "age": 45},
    {"first_name": "John", "surname": "Smith", "age": 30},
    {"first_name": "Maria", "surname": "Garcia", "age": 28},
    {"first_name": "Isabelle", "surname": "Leblanc", "age": 35},
    {"first_name": "Hans", "surname": "Schneider", "age": 50},
    {"first_name": "Ali", "surname": "Khan", "age": 22},
    {"first_name": "Claire", "surname": "Martin", "age": 33},
    {"first_name": "Lisa", "surname": "Brown", "age": 29},
    {"first_name": "Robert", "surname": "Davies", "age": 38},
    {"first_name": "Lucia", "surname": "Rodriguez", "age": 27},
    {"first_name": "Sajid", "surname": "Patel", "age": 40},
    {"first_name": "Terry", "surname": "Thompson", "age": 41},
    {"first_name": "Mei", "surname": "Yan", "age": 34},
    {"first_name": "Pedro", "surname": "Ortega", "age": 27}
]


@app.route('/personnes', methods=['GET'])
def get_personnes():
    # Retourner la liste des personnes au format JSON
    return jsonify(personnes)

if __name__ == '__main__':
    app.run(debug=True)
    
    # adresse du serveur: http://127.0.0.1:5000/
    
    # libération du port 5000
    # lsof -i:5000
    # kill -9 PID 