package logicielslibres.fr.medecin1;

import android.app.DatePickerDialog;
import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.EditText;
import androidx.appcompat.app.AppCompatActivity;
import java.util.Calendar;

public class ActivitePrescriptions extends AppCompatActivity {

    private EditText editDateDebut;
    private EditText editDateFin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activite_prescriptions);

        editDateDebut = findViewById(R.id.editDateDebut);
        editDateFin = findViewById(R.id.editDateFin);

        // Ajouter le listener pour le champ de date de début
        editDateDebut.setOnClickListener(v -> showDatePickerDialog(editDateDebut));

        // Ajouter le listener pour le champ de date de fin
        editDateFin.setOnClickListener(v -> showDatePickerDialog(editDateFin));

        // configuration pour le bouton précédent
        Button boutonPrecedent = findViewById(R.id.boutonPrecedent);
        boutonPrecedent.setOnClickListener(v -> pagePrecedente());

        // configuration pour le bouton de validation
        Button boutonSuivant = findViewById(R.id.boutonValidation);
        boutonSuivant.setOnClickListener(v -> pageSuivante());
    }

    // calendrier pour les dates
    private void showDatePickerDialog(EditText dateField) {
        // Obtenez la date actuelle pour initialiser le DatePickerDialog
        final Calendar calendar = Calendar.getInstance();
        int year = calendar.get(Calendar.YEAR);
        int month = calendar.get(Calendar.MONTH);
        int day = calendar.get(Calendar.DAY_OF_MONTH);

        DatePickerDialog datePickerDialog = new DatePickerDialog(
                this,
                (view, year1, month1, dayOfMonth) -> {
                    // Format de la date sélectionnée
                    String selectedDate = dayOfMonth + "/" + (month1 + 1) + "/" + year1;
                    dateField.setText(selectedDate);
                },
                year, month, day
        );
        datePickerDialog.show();
    }

    private void pagePrecedente() {
        // Naviguer vers la page précédente (par exemple, ActiviteAvis)
        Intent intent = new Intent(ActivitePrescriptions.this, ActiviteAvis.class);
        startActivity(intent);
        finish(); // Optionnel : Terminez l'activité actuelle si vous ne voulez pas qu'elle soit en arrière-plan
    }

    private void pageSuivante() {
        // Naviguer vers la page suivante
        // Ajoutez ici la logique pour naviguer vers la prochaine page si nécessaire
    }
}

