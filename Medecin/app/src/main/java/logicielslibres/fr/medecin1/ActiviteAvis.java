package logicielslibres.fr.medecin1;

import android.app.DatePickerDialog;
import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.EditText;
import androidx.appcompat.app.AppCompatActivity;
import java.util.Calendar;

import logicielslibres.fr.medecin1.ActivitePagePrincipale;

public class ActiviteAvis extends AppCompatActivity {

    private EditText editDate;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activite_avis);

        editDate = findViewById(R.id.editDate);

        // Ajouter le listener pour le champ de date
        editDate.setOnClickListener(v -> showDatePickerDialog());

        // configuration du bouton précédent
        Button boutonPrecedent = findViewById(R.id.boutonPrecedent);
        boutonPrecedent.setOnClickListener(v -> pagePrecedente());

        // configuration du bouton suivant
        Button boutonSuivant = findViewById(R.id.boutonSuivant);
        boutonSuivant.setOnClickListener(v -> pageSuivante());
    }

    // calendrier pour la date
    private void showDatePickerDialog() {
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
                    editDate.setText(selectedDate);
                },
                year, month, day
        );
        datePickerDialog.show();
    }

    private void pagePrecedente() {
        // Naviguer vers la page précédente
        Intent intent = new Intent(ActiviteAvis.this, ActivitePagePrincipale.class);
        startActivity(intent);
        finish(); // Optionnel : Terminez l'activité actuelle si vous ne voulez pas qu'elle soit en arrière-plan
    }

    private void pageSuivante() {
        Intent intent = new Intent(ActiviteAvis.this, ActivitePrescriptions.class);
        startActivity(intent);
        finish(); // Optionnel : Terminez l'activité actuelle si vous ne voulez pas qu'elle soit en arrière-plan
    }
}
