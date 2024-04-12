# généré par ChatGPT 

from flask import Flask, jsonify
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://gerard:q0In942kg91o!@localhost/university'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)

class Student(db.Model):
    __tablename__ = 'students'
    id = db.Column(db.Integer, primary_key=True)
    first_name = db.Column(db.String(50), nullable=False)
    surname = db.Column(db.String(50), nullable=False)
    age = db.Column(db.Integer, nullable=False)

    def __repr__(self):
        return f'<Student {self.name} {self.firstname}>'

@app.route('/students')
def index():
    try:
        students = Student.query.all()
        student_data = [{"id": student.id, "first_name": student.first_name, "surname": student.surname, "age": student.age} for student in students]
        return jsonify(student_data)
    except Exception as e:
        app.logger.error(f"Failed to fetch student data: {e}")
        return jsonify({"error": "Unable to fetch data"}), 500

if __name__ == '__main__':
    app.run(debug=True)  # Définissez debug=True pour le développement pour obtenir plus d'informations en cas d'erreurs


# adresse du serveur: http://127.0.0.1:5000/
    
    # libération du port 5000
    # lsof -i:5000
    # kill -9 PID 