import okhttp3.RequestBody;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.Header;
import retrofit2.http.POST;

public interface ApiService {
    @POST("formulaireAvis")
    Call<ResponseBody> transfertJSONAvis(@Body RequestBody body);

    @POST("formulairePrescription")
    Call<ResponseBody> transfertJSONPrescription(@Header("Authorization") String authToken, @Body RequestBody body);
}
